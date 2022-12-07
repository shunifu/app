SELECT marks.student_id,
    GROUP_CONCAT(subjects.subject_name) AS subject_name,
    subjects.id as subject_id,
    assessements.term_id as term_id,
    teaching_loads.class_id as student_class,
    teaching_loads.id as teaching_load_id,
    (AVG(CASE WHEN  c_a__exams.term_id=1 AND c_a__exams.assign_as = 'CA' THEN marks.mark END))AS ca,
    (AVG(CASE WHEN  c_a__exams.term_id=1 AND c_a__exams.assign_as = 'Examination' THEN marks.mark END))AS exam,
    (AVG(CASE WHEN  c_a__exams.term_id=1 AND c_a__exams.assign_as = 'CA' THEN (marks.mark)*0.4 END))AS ca_weight,
    (AVG( CASE WHEN  c_a__exams.term_id=1 AND c_a__exams.assign_as = 'Examination' THEN (marks.mark)*0.6 END)) as exam_weight
    FROM
    marks
    INNER JOIN c_a__exams ON c_a__exams.assessement_id = marks.assessement_id
    INNER JOIN assessements ON assessements.id = marks.assessement_id
    INNER JOIN teaching_loads ON teaching_loads.id = marks.teaching_load_id
    INNER JOIN subjects ON subjects.id = teaching_loads.subject_id
    WHERE marks.student_id = 2040 AND `assessements`.`term_id` = 1 AND marks.active=1
    GROUP BY
    marks.student_id,
    subjects.id