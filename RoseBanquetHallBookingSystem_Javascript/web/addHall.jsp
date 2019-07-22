<%-- 
    Document   : addHall
    Created on : 18-Apr-2018, 3:46:35 PM
    Author     : elliottadic
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Hall</title>
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
        <h1>Add Hall</h1>
        <form action="RoseBanquetHallServlet" method="GET">
            <br>Name: <input type="text" name="name" size="15"><span style="color: Red;"> <%= error%> </span>
            
            <br><br><input type="submit" name="action" value="Register Hall">
        </form> <br>
        <form style="display:inline-block;" action="index.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>

    </body>
</html>