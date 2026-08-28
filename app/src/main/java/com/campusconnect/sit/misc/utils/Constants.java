package com.campusconnect.sit.misc.utils;

/**
 * Created by Anil on 25/09/2019.
 */

public class Constants {

    /**
     * Permission
     */

    public static final int PERMISSIONS_REQ = 1;

    /**
     * Server Links
     *
     * Uses BASE_URL for all server endpoints.
     * The default value (10.0.2.2) allows the Android Emulator
     * to connect to the host machine's local server.
     * For a physical device, update BASE_URL to your computer's LAN IP.
     *
     * SRegisterUrl also uses the same BASE_URL so that
     * student self-registration works correctly.
     */
    public static final String BASE_URL = "http://10.0.2.2/campusconnect";

    public static final String SRegisterUrl = BASE_URL + "/register.php";
    public static final String SLoginUrl = BASE_URL + "/login.php";

    public static final String TRegisterUrl = BASE_URL + "/otherregister.php";
    public static final String TLoginUrl = BASE_URL + "/otherlogin.php";

    public static final String NTegisterUrl = BASE_URL + "/nontregister.php";
    public static final String NTLoginUrl = BASE_URL + "/nontlogin.php";

    public static final String SYLLABUSDATA = BASE_URL + "/syllabus/syllabusTeacher.php";

    public static final String SAVINGSYLLABUS = BASE_URL + "/syllabus/saveSyllabus.php";
    public static final String UNSAVINGSYLLABUS = BASE_URL + "/syllabus/unsaveSyllabus.php";

    public static final String LOADSYLLABUS = BASE_URL + "/syllabus/dataStudent.php";

    public static final String UPLOADFILES = BASE_URL + "/upload.php";
    public static final String CMPNUPLOAD = BASE_URL + "/cmpnupload.php";
    public static final String ITUPLOAD = BASE_URL + "/itupload.php";
    public static final String EXTCUPLOAD = BASE_URL + "/extcupload.php";
    public static final String ETRXUPLOAD = BASE_URL + "/etrxupload.php";
    public static final String MECHUPLOAD = BASE_URL + "/mechupload.php";
    public static final String CIVILUPLOAD = BASE_URL + "/civilupload.php";

    public static final String UPLOADFILESG = BASE_URL + "/gupload.php";

    public static final String FILEVIEWS = BASE_URL + "/getuploaded.php";
    public static final String FILEVIEWS2 = BASE_URL + "/getuploadedg.php";

    public static final String FORGOTPASS = BASE_URL + "/forgotpassword.php";

    public static final String FORGOTPASST = BASE_URL + "/forgotpasswordt.php";

    public static final String FORGOTPASSNT = BASE_URL + "/forgotpasswordnt.php";


    public static final String TAKEATTENDANCE = BASE_URL + "/attendance/insertAttendance.php";

    public static final String VIEWATTENDANCE = BASE_URL + "/attendance/viewAttendance.php";


    /**
     * Preferences
     */
    public static final String INOUROUT = "loggedIn";
    public static final String USERNAME = "username";
    public static final String STUDENT_LOGIN = "studentlogin";
    public static final String TEACHER_LOGIN = "teacherlogin";
    public static final String NTEACHER_LOGIN = "nteacherlogin";
    public static final String STUDENT_LOGIN_TRACK = "strack";
    public static final String TEACHER_LOGIN_TRACK = "ttrack";
    public static final String NTEACHER_LOGIN_TRACK = "nttrack";
    public static final String STUDENTINIT = "branch";
    public static final String ONETIMESCREEN = "onetimescreen";
    public static final String BRANCHCMPN = "branchcmpn";
    public static final String COMMONYR = "year";
    public static final String FOURTHYR = "fourth_year";
    public static final String SUBJECTNAME = "subjectname";
    public static final String STARTDATE = "startdate";
    public static final String ENDDATE = "enddate";
    public static final String ATDATA = "atdata";
    public static final String COUNTER = "counter";
    public static final String SYLLABUS = "syllabus";
    public static final String NOTICETRACK = "noticeTrack";


    /**
     * Extras
     */
    public static final String DATE_FORMAT_NOW = "yyyy-MM-dd HH:mm:ss";

}
