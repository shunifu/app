// require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;
import'jquery/dist/jquery.min.js';
//  import 'jquery-ui/ui/widgets/datepicker.js';
import'admin-lte/plugins/datatables/jquery.dataTables.min.js';
import'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';
import'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js';
import'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js';
import'admin-lte/plugins/select2/js/select2.full.min.js';
import'admin-lte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.js';
import 'alpinejs';

import * as Sentry from "@sentry/browser";
import { BrowserTracing } from "@sentry/tracing";

Sentry.init({
  dsn: "https://0701117299e74662b3a04ca8e163a1d1@o1159782.ingest.sentry.io/6244090",
  integrations: [new BrowserTracing()],

  // Set tracesSampleRate to 1.0 to capture 100%
  // of transactions for performance monitoring.
  // We recommend adjusting this value in production
  tracesSampleRate: 1.0,
});




