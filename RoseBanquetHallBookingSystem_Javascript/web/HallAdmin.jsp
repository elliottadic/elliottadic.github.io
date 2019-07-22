<%-- 
    Document   : HallAdmin
    Created on : 18-Apr-2018, 3:47:50 PM
    Author     : elliottadic
--%>

<%@page import="java.util.ArrayList"%>
<%@page import="data.Hall"%>
<%@page import="data.HallDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Hall Admin</title>
    </head>
    <body>
         <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <h1>Hall Administration</h1>
        <ol>
            <%
                HallDAO HDAO = new HallDAO();
                ArrayList<Hall> Halls = HDAO.retrieveHalls();

                for (Hall h : Halls) {
                    if (!h.getName().equals("")) {


            %>
            <li style="margin: 20px 0">
                <form action="RoseBanquetHallServlet" method="GET">
                    <%=h.getName()%> 

                    <input type="submit" name="action" value="Delete Hall" style="float: right; margin-right: 800px; display:inline-block;">
                    <input type="submit" name="action" value="Edit Hall" style="float: right; display:inline-block;">
                    <input type="hidden" name="ID" value="<%=h.getID()%>">
                </form>
            </li>
            <%
                    }
                }
            %>
        </ol>

        <form style="display:inline-block;" action="addHall.jsp" method="GET">

            <input type="submit" value="Add Hall">

        </form>

        <form style="display:inline-block;" action="index.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>
    </body>
</html>
