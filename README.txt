This activity plugin was created using this templage: https://github.com/moodlehq/moodle-mod_newmodule

To use

1) Copy the files and folders in this repository into mod/qrcode.
2) Setup a user with a token to use the Moodle web service.
    a) Go to: Site administration > Users > Permissions > Define roles
    b) Click the "Add a new role" button
    c) Click the "Continue" button to define a new role
    d) Name the custom role "App"
    e) In the context part, choose System to assign this role from everywhere in the system
    f) Search in the "Filter" search box for the following and check "Allow"
        - Edit grades
        - Use REST protocol
    g) Go to:  Site administration > Plugins > Web services > External services
    h) Click "Add"
    i) On the "External service" page, fill in the details as follows
        - Name: GradeQR Web Service
        - Short Name: GradeQR
        - Click "Add service"
    j) Click "Add functions"
    k) Search for and add "core_grades_update_grades"
    l) Click "Add functions"
    m) Create a user named GradeQR App
    n) Go to Site administrator > Users > Permissions > Assign system roles
    o) Click on "App"
    p) Add the "GradeQR App" user to the "Existing users" list
    q) Go to Site administrator > Web services > Manage protocals and enable the REST protocol
    r) Go to Site administrator > Web services > Manage tokens and click "Add"
        - User: GradeQR App
        - Service: GradeQR Web Service
        - Click "Save changes
    
3) Download and setup the app to work with your server.

Currently, GradeQR is a plugin, an App, and an idea. The idea is to allow teachers to grade assignments by scanning a QR code. Generally I use this technique to make grading assignments during class go more quickly, but there are many applications. For example, students could copy and paste the QR codes into their assignments. Or, you might use it as a way to quickly record that they have participated in a class discussion.

This plugin is a very simple activity plugin that encodes the server's url, the course id, the activity id, the student id, and the maximum grade for the assignment into a QR code. Upon scanning the QR code, an app submits a grade to the server using Moodle's web service capability. To communicate with the server, the administrator does need to provide users of the app with a token.