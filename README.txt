This activity plugin was created using this templage: https://github.com/moodlehq/moodle-mod_newmodule

Currently, MoodleQR is a plugin, an App, and an idea. The idea is to allow teachers to grade assignments by scanning a QR code. Generally I use this technique to make grading assignments during class go more quickly, but there are many applications. For example, students could copy and paste the QR codes into their assignments.

Currently, the plugin is a very simple activity plugin that encodes the server's url, the course id, the activity id, the student id, and the maximum grade for the assignment into a QR code. Upon scanning the QR code, an app submits a grade to the server using Moodle's web service capability. To communicate with the server, the administrator does need to provide users of the app with a token.

While the plugin is functional, I am fairly certain it is in need of improvement as this is my first plugin and I'm not sure of the best way to go about adding code.
1. Where should I put it?
2. What methods should I use for adding it?

Any pointers would be greatly appreciated.

While this plugin serves my purposes, it would be better if this concept were integrated into the assign activity plugin as a submission type. I foresee wanting to using the same Moodle course with other teachers who would like to grade their students using a more conventional submission type while I scan QR codes. I attempted to make this modification to the assign activity plugin myself, but I was unsure how to go about making this modification.
1. How do I add a checkbox?
2. How do I add a corresponding field to the database to record this setting?
3. Where do I add the code that would display the QR code?

Again, any pointers would be greatly apprediated.
