<%-- 
    Document   : index
    Created on : 23-Mar-2018, 3:02:27 AM
    Author     : elliottadic
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Home</title>
    </head>
    <body>
        <h1>HOCKEY LEAGUE</h1>
        <img src="./images/Hockey.jpg" alt="Hockey" style="height:150px; width: 300px;">
        <form action="showTeam.jsp">
            Team:  <select name="teamHome">
                <option>Red</option><option>Blue</option>

            </select>
            <br><input type="submit" value="View Team" style="margin-top: 20px">

        </form>
    </body>
</html>
