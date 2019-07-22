<%-- 
    Document   : bookHall
    Created on : 9-Apr-2018, 4:50:31 PM
    Author     : elliottadic
--%>
<%@page import="data.Client"%>
<%@page import="data.ClientDAO"%>
<%@page import="java.util.ArrayList"%>
<%@page import="data.Hall"%>
<%@page import="data.HallDAO"%>
<%@page import="java.util.Date" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add booking</title>
    </head>
    <body>
        <%! String error = "";%>
        <%

            error = String.valueOf(request.getAttribute("Error"));

            if (error == "null") {
                error = "";
            } else {
                error = String.valueOf(request.getAttribute("Error"));
            }

        %>
        <img src='rose.jpg' alt="rose">
        <h1>Rose Banquet Halls</h1>
        <h1>Book Hall</h1>
        <form action="RoseBanquetHallServletThree" method="GET">

            <br>Select Hall: <select name="halls">

                <%                HallDAO HDAO = new HallDAO();
                    ArrayList<Hall> Halls = HDAO.retrieveHalls();

                    for (Hall h : Halls) {
                        if (!h.getName().equals("")) {
                %>
                <option value="<%=h.getID()%>"><%=h.getName()%> </option>
                <%
                        }
                    }

                %>
            </select>
            <br>Select Client: <select name="client">
                <%                ClientDAO CDAO = new ClientDAO();
                    ArrayList<Client> clients = CDAO.retrieveClients();

                    for (Client c : clients) {
                        if (!c.getName().equals("")) {
                            char[] numberChars = c.getCreditCard().toCharArray();
                           
                            numberChars[0] = '*';
                            numberChars[1] = '*';
                            numberChars[2] = '*';
                            numberChars[3] = '*';
                            numberChars[4] = '*';
                            numberChars[5] = '*';
                            numberChars[6] = '*';
                            numberChars[7] = '*';
                           
                            String hiddenNumber = String.valueOf(numberChars);
                %>
                <option value="<%=c.getID()%>">Name: <%=c.getName()%> ____ Card#:<%=hiddenNumber%> </option>
                <%
                        }
                    }

                %>
            </select>
            <br>Enter Date: <input type="date" name="date"><br>
            <span style="color: Red;"> <%= error%> </span>

            <br><br><input type="submit" name="action" value="Register Booking">
        </form>
            <br>
        <form style="display:inline-block;" action="index.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>
    </body>
</html>
