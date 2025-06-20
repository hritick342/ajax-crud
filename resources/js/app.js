// 1. ✅ Import jQuery FIRST
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// app.js
import * as bootstrap from 'bootstrap'; // ✅ this makes it available as a variable
window.bootstrap = bootstrap; // ✅ attach it globally if you're using it in inline scripts

// 3. ✅ Now import your custom scripts (that use jQuery)
import './ajax-crud.js';
import 'bootstrap/dist/css/bootstrap.min.css';
