<%@page import="java.sql.*"%>
<%@page import="java.util.*"%>
<%@page import="javax.mail.*"%>
<%@ page import="java.net.InterfaceAddress" %>
<%@ page import="javax.mail.internet.*" %>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<%
    String databaseURL = "jdbc:mysql://localhost:3306/4300_products?serverTimezone=EST";
    String databaseUsername = "root";
    String databasePassword = "G97t678!";
    Connection connection = null;
    try{
        //CONNECTING TO THE DATABASE & GRABBING THE USERS SO WE CAN DO STUFF
        connection = DriverManager.getConnection(databaseURL, databaseUsername, databasePassword);
        if(request.getParameter("join") !=null){
            String newUserQuery = "INSERT INTO users (email, firstName, lastName, password, admin) VALUES (?, ?, ?, ?, ?) ";
            PreparedStatement newUserQuery_prep = connection.prepareStatement(newUserQuery);
            newUserQuery_prep.setString(1, request.getParameter("rEmail"));
            newUserQuery_prep.setString(2, request.getParameter("rFirstName"));
            newUserQuery_prep.setString(3, request.getParameter("rLastName"));
            newUserQuery_prep.setString(4, request.getParameter("rPassword"));
            newUserQuery_prep.setInt(5, 0);
            newUserQuery_prep.executeUpdate();

            //how we're sending the confirmation email
            final String eUser = "4300.e.store@gmail.com";
            final String ePassword = "iafiffebihzntzdy";
            String to = request.getParameter("rEmail");
            String from = "4300.e.store@gmail.com";

            Properties prop = System.getProperties();
            prop.put("mail.smtp.host", "smtp.gmail.com");
            prop.put("mail.smtp.port", "587");
            prop.put("mail.smtp.starttls.enable", "true");
            prop.put("mail.smtp.auth", "true");
            prop.put("mail.smtp.ssl.trust", "*");

            Session sess = Session.getInstance(prop, new javax.mail.Authenticator() {
                protected PasswordAuthentication getPasswordAuthentication(){
                    return new PasswordAuthentication(eUser, ePassword);
                }
            });
            try{
                MimeMessage context = new MimeMessage(sess);
                InternetAddress fromIA = new InternetAddress(from);
                context.setFrom(from);
                if(to != null) {
                    InternetAddress toIA = new InternetAddress(to);
                    context.addRecipient(Message.RecipientType.TO, toIA);

                    context.setSubject("Registration Confirmation");
                    context.setText("Thanks for creating your STORE NAME account!");
                    System.out.println("sending email...");
                    Transport.send(context);
                    System.out.println("Message sent successfully.");
                }
            }catch(MessagingException mE){
                mE.printStackTrace();
            }

        }
        String userQuery = "SELECT email, password, admin FROM users ";
        PreparedStatement prep1 = connection.prepareStatement(userQuery);
        ResultSet userResults = prep1.executeQuery(userQuery);

%>
<body>
<div class="master-container">
    <h1 class="LTitle">WELCOME TO STORE NAME!</h1>
    <form class="login" method="post" action="Login.jsp">
        <div class="input">
            <!-- Email area -->
            <h2 class="miniLTitle">LOGIN</h2>
            <p class="ETitle">Email</p>
            <input type="text" id="user" name="user" tabindex="1" placeholder="Email" required/>

            <!-- Password area -->
            <p class="PTitle">Password</p>
            <input type="password" id="password" name="password" tabindex="2" placeholder="Password" required/>

            <!-- login button -->
            <button type="submit" class="loginButton">LOGIN</button>
            <div class="notRegistered">
                <button type="button" class="forgotPassword" id="fButton" data-toggle="modal" data-target="#passModal">
                    Forgot Password?
                </button>
                <button type="button" class="forgotPassword" id="rButton" data-toggle="modal" data-target="#regModal">
                    Register
                </button>

            </div>
        </div>
    </form>

    <%
        if(request.getParameter("user") != null){
            while(userResults.next()){
                if(request.getParameter("user").equals(userResults.getString(1))){
                    if(request.getParameter("password").equals(userResults.getString(2))){
                        if(userResults.getInt(3) == 1){%>
                            <form id="checkLogin" name="checkLogin" method="post" action="index.html">
                                <input type="checkbox" hidden checked id="loggedIn" name="loggedIn">
                            </form>
                            <script>
                                document.getElementById("checkLogin").action ="http://localhost:63342/Group_4300_Project/src/main/webapp/admin_pages/index.php?_ijt=4uuhsp2s9t5m8iojslrf6ji95e";
                                document.getElementById("checkLogin").submit();
                            </script>
    <%

        }%>
                            <script>
                                document.getElementById("checkLogin").action ="http://localhost:63342/Group_4300_Project/src/main/webapp/index.php?_ijt=vi3sg60uigguqui27mglus0tmh";
                                document.getElementById("checkLogin").submit();
                            </script>

    <%             }
    }
    }
    }
    %>

    <div class="modal fade" id="passModal" role="dialog">
        <form class="forgot" method="post" action="Login.jsp">
            <h5 class="modalTitle">Enter your email and we will send you a temporary password.</h5>
            <input type="email" id="fEmail" name="fEmail" placeholder="Enter Email" required/>
            <button type="submit" class="forgotButton" name="frButton" id="frButton">Send Temporary Password</button>
            <button type="button" class="close" id="close" data-dismiss="modal">Close</button>
        </form>
        <%

            if (request.getParameter("frButton") != null) {
                Random rand = new Random();
                int capLetters = rand.nextInt((90 - 65) + 1) + 65;
                int lowerLetters = rand.nextInt((122 - 97) + 1) + 97;
                int numbers = rand.nextInt((57 - 48) + 1) + 65;
                String password = "";
                char cL = 'a';
                char sL = 'a';
                char nL = 'a';
                int count = 0;
                int options = rand.nextInt(3);

                while (count < 8) {
                    if ((count == 0) || (count == 4) || (count == 7)) {//this is for the first letter
                        if (options == 0) {
                            cL = (char) capLetters;
                            password += cL;
                            capLetters = rand.nextInt((90 - 65) + 1) + 65;
                            ++count;
                        } else if (options == 1) {
                            nL = (char) numbers;
                            password += nL;
                            numbers = rand.nextInt((57 - 48) + 1) + 65;
                            ++count;
                        } else {
                            sL = (char) lowerLetters;
                            password += sL;
                            lowerLetters = rand.nextInt((122 - 97) + 1) + 97;
                            ++count;
                        }
                    }//rando options

                    if ((count == 2) || (count == 5)) {
                        //second letter
                        cL = (char) capLetters;
                        password += cL;
                        capLetters = rand.nextInt((90 - 65) + 1) + 65;
                        ++count;
                    }//cap letters

                    if ((count == 3)) {
                        sL = (char) lowerLetters;
                        password += sL;
                        lowerLetters = rand.nextInt((122 - 97) + 1) + 97;
                        ++count;
                    }//third letter

                    nL = (char) numbers;
                    numbers = rand.nextInt((57 - 48) + 1) + 65;
                    password += nL;
                    ++count;
                }

                final String eUser = "4300.e.store@gmail.com";
                final String ePassword = "iafiffebihzntzdy";
                String to = request.getParameter("fEmail");
                String from = "4300.e.store@gmail.com";

                Properties prop = System.getProperties();
                prop.put("mail.smtp.host", "smtp.gmail.com");
                prop.put("mail.smtp.port", "587");
                prop.put("mail.smtp.starttls.enable", "true");
                prop.put("mail.smtp.auth", "true");
                prop.put("mail.smtp.ssl.trust", "*");

                Session sess = Session.getInstance(prop, new javax.mail.Authenticator() {
                    protected PasswordAuthentication getPasswordAuthentication() {
                        return new PasswordAuthentication(eUser, ePassword);
                    }
                });

                try {
                    MimeMessage context = new MimeMessage(sess);
                    InternetAddress fromIA = new InternetAddress(from);
                    context.setFrom(from);
                    if (to != null) {
                        InternetAddress toIA = new InternetAddress(to);
                        context.addRecipient(Message.RecipientType.TO, toIA);

                        context.setSubject("Reset Your Password");
                        context.setText("Here is your temporary password: " + password);
                        System.out.println("sending email...");
                        Transport.send(context);
                        System.out.println("Message sent successfully.");
                    }
                } catch (MessagingException mE) {
                    mE.printStackTrace();
                }
                String updatePassword = "UPDATE users SET password = ? where email = ? ";
                PreparedStatement pstmt = connection.prepareStatement(updatePassword);
                pstmt.setString(1, password);
                pstmt.setString(2, request.getParameter("fEmail"));
                pstmt.executeUpdate();

            }
        %>
    </div>
    <div class="modal fade" id="regModal" role="dialog">
        <form class="register" method="post" action="Login.jsp">
            <h5 class="mTitle">Register</h5>
            <label class="form-label" for="rFirstName">First Name</label>
            <div class="regRows">
                <input type="text" class="fields" id="rFirstName" name="rFirstName" placeholder="First Name" required/>
            </div>
            <label class="form-label" for="rLastName">Last Name</label>
            <div class="regRows">
                <input type="text" class="fields" id="rLastName" name="rLastName" placeholder="Last Name" required/>
            </div>
            <label class="form-label" for="rEmail">Email</label>
            <div class="regRows">
                <input type="email" class="fields" id="rEmail" name="rEmail" placeholder="Enter Email" required/>
            </div>
            <label class="form-label" for="rPassword">Password</label>
            <div class="regRows">
                <input type="password" class="fields" id="rPassword" name="rPassword" placeholder="Password" required/>
            </div>
            <label class="form-label" for="rCPassword">Confirm Password</label>
            <div class="regRows">
                <input type="password" class="fields" id="rCPassword" name="rCPassword" placeholder="Confirm Password" required/>
            </div>
            <button type="submit" class="forgotButton" id="join" name="join">JOIN</button>
            <button type="button" class="close" id="rClose" data-dismiss="modal" name="rClose">Close</button>
        </form>

    </div>
    <script>
        var passwordModal = document.getElementById("passModal");
        var passButton= document.getElementById("fButton");
        var closer = document.getElementById("close");
        var regModal = document.getElementById("regModal");
        var regButton= document.getElementById("rButton");
        var close = document.getElementById("rClose");


        //clicking the forgot password button will reveal the modal
        passButton.onclick = function(){
            passwordModal.style.display = "block";
        }
        //clicking the close button will dismiss the modal
        closer.onclick = function() {
            passwordModal.style.display = "none";
        }

        //clicking the register button will reveal the modal
        regButton.onclick = function(){
            regModal.style.display = "block";
        }
        //clicking the close button will dismiss the modal
        close.onclick = function() {
            regModal.style.display = "none";
        }

    </script>
</div>

<%
    } catch (SQLException e){
        e.printStackTrace();
    }
%>

</body>
</html>