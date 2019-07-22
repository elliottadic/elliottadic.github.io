<%-- 
    Document   : registerClient
    Created on : 9-Apr-2018, 4:52:31 PM
    Author     : elliottadic
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Register Client</title>
    </head>
    <body>
        <%! String name = "";%>
        <%! String error = "";%>
        <%
            
        error = String.valueOf(request.getAttribute("Error"));
        
        if (error == "null"){
        error = "";
        }
        else{
        error = String.valueOf(request.getAttribute("Error"));
        }
        
        %>
        <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <h1>Register Client</h1>
        <form action="RoseBanquetHallServletTwo" method="GET">
            <br>Name: <input type="text" name="name" size="15">
            <br>Credit Card: <input type="text" name="number" size="15"><br>
            <span style="color: Red;"> <%= error%> </span>

            <br><br><input type="submit" name="action" value="Register Client">
        </form><br>
        <form style="display:inline;" action="index.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>

    </body>
</html>
