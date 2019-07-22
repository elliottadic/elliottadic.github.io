<%-- 
    Document   : ClientAdmin
    Created on : 18-Apr-2018, 7:13:33 PM
    Author     : elliottadic
--%>

<%@page import="java.util.ArrayList"%>
<%@page import="data.Client"%>
<%@page import="data.ClientDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Client Admin</title>
    </head>
    <body>
        <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <h1>Client Administration</h1>
        <ol>
            <%
                ClientDAO CDAO = new ClientDAO();
                ArrayList<Client> clients = CDAO.retrieveClients();
                String hiddenNumber = "";
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

                        hiddenNumber = String.valueOf(numberChars);


            %>
            <li style="margin: 20px 0">
                <form action="RoseBanquetHallServletTwo" method="GET">
                    Name: <%=c.getName()%> <br>
                    Card Number: <%=hiddenNumber%> 
                    <input type="submit" name="action" value="Delete Client" style="float: right; margin-right: 800px; display:inline-block;">
                    <input type="submit" name="action" value="Edit Client" style="float: right; display:inline-block;">
                    <input type="hidden" name="ID" value="<%=c.getID()%>">
                </form>
            </li>
            <%
                    }
                }
            %>
        </ol>

        <form style="display:inline-block;" action="registerClient.jsp" method="GET">

            <input type="submit" value="Add Client">

        </form>

        <form style="display:inline-block;" action="index.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>
    </body>
</html>
