This activity plugin was created using this templage: https://github.com/moodlehq/moodle-mod_newmodule

To use

1) Copy the files and folders in this repository into mod/qrcode.
2) Setup a user with a token to use the Moodle web service.
3) Download and setup the app to work with your server.

Currently, GradeQR is a plugin, an App, and an idea. The idea is to allow teachers to grade assignments by scanning a QR code. Generally I use this technique to make grading assignments during class go more quickly, but there are many applications. For example, students could copy and paste the QR codes into their assignments. Or, you might use it as a way to quickly record that they have participated in a class discussion.

Currently, the plugin is a very simple activity plugin that encodes the server's url, the course id, the activity id, the student id, and the maximum grade for the assignment into a QR code. Upon scanning the QR code, an app submits a grade to the server using Moodle's web service capability. To communicate with the server, the administrator does need to provide users of the app with a token.