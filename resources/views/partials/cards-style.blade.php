<style>

    /* Cards */
.card {
  border: 0;
  background: #fff;

  border-radius: 1.375rem;
}
  .card .card-body {
    padding: 1rem 1rem; }
    .card .card-body + .card-body {
      padding-top: 1rem; }
   .card .card-title {
    color: #343a40;
    text-transform: capitalize;
    font-size: 1.125rem; }



  .card.card-rounded {
    border-radius: 5px; }
  .card.card-faded {
    background: #b5b0b2;
    border-color: #b5b0b2; }

  .card.card-img-holder {
    position: relative; }
    .card.card-img-holder .card-img-absolute {
      position: absolute;
      top: 0;
      right: 0;
      height: 100%; }


  .text-warning {
    color: #f5803e!important;
}

.font-weight-normal {
    font-weight: 350!important;
}

  .card-deck .card {
    margin-bottom: .5rem
}

@media (min-width: 576px) {
    .card-deck {
        display:-webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: horizontal;

        -ms-flex-flow: row wrap;
        flex-flow: row wrap;
        margin-right: -.5rem;
        margin-left: -.5rem;
    }

    .card-deck .card {
        -webkit-box-flex: 1;
        -ms-flex: 1 0 0%;
        flex: 1 0 0%;
        margin-right: .5rem;
        margin-bottom: 0;
        margin-left: .5rem
    }
}

table.table-bordered{
    border:1px solid white;

  }

  table.tr{
    text-align:center;
  }
table.table-bordered > thead > tr > th{
    border:1px solid rgba(98, 98, 98, 0.134);
      text-align:center;
      font-weight: normal;
}
table.table-bordered > tbody > tr > td{
    border:1px solid rgba(98, 98, 98, 0.134);
      text-align:center;
      font-weight: normal;
}

</style>
