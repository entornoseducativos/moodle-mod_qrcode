<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Prints a particular instance of qrcode
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    mod_qrcode
 * @copyright  2018 Michael Backus {@link http://www.akrobotnerd.com/gradeqr}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Replace qrcode with the name of your module and remove this line.

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');
require_once($CFG->libdir.'/tcpdf/tcpdf_barcodes_2d.php');

$id = optional_param('id', 0, PARAM_INT); // Course_module ID, or
$n  = optional_param('n', 0, PARAM_INT);  // ... qrcode instance ID - it should be named as the first character of the module.

if ($id) {
    $cm         = get_coursemodule_from_id('qrcode', $id, 0, false, MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
    $qrcode     = $DB->get_record('qrcode', array('id' => $cm->instance), '*', MUST_EXIST);
} else if ($n) {
    $qrcode     = $DB->get_record('qrcode', array('id' => $n), '*', MUST_EXIST);
    $course     = $DB->get_record('course', array('id' => $qrcode->course), '*', MUST_EXIST);
    $cm         = get_coursemodule_from_instance('qrcode', $qrcode->id, $course->id, false, MUST_EXIST);
} else {
    error('You must specify a course_module ID or an instance ID');
}

require_login($course, true, $cm);

$event = \mod_qrcode\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $qrcode);
$event->trigger();

// Print the page header.

$PAGE->set_url('/mod/qrcode/view.php', array('id' => $cm->id));
$PAGE->set_title(format_string($qrcode->name));
$PAGE->set_heading(format_string($course->fullname));

/*
 * Other things you may want to set - remove if not needed.
 * $PAGE->set_cacheable(false);
 * $PAGE->set_focuscontrol('some-html-id');
 * $PAGE->add_body_class('qrcode-');
*/

// Output starts here.
echo $OUTPUT->header();

// Conditions to show the intro can change to look for own settings or whatever.
if ($qrcode->intro) {
    echo $OUTPUT->box(format_module_intro('qrcode', $qrcode, $cm->id), 'generalbox mod_introbox', 'qrcodeintro');
}

$qrcodedata = $CFG->wwwroot.','.$COURSE->id.','.$cm->id.','.$USER->id.','.$qrcode->grade;
$barcode = new TCPDF2DBarcode($qrcodedata, 'QRCODE');
$image = $barcode->getBarcodePngData(12, 12);
echo html_writer::img('data:image/png;base64, '.base64_encode($image), $qrcodedata);

// Finish the page.
echo $OUTPUT->footer();
