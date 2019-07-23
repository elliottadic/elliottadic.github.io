<%-- 
    Document   : showTeam
    Created on : 23-Mar-2018, 3:08:10 PM
    Author     : elliottadic
--%>


<%@page import="java.util.ArrayList"%>
<%@page import="data.Player"%>
<%@page import="data.playerDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Team</title>
    </head>
    <body>
        <h1>HOCKEY LEAGUE</h1>
        <ol>
            <%
                playerDAO PDAO = new playerDAO();
                ArrayList<Player> players = PDAO.retrieveAllPlayers(request.getParameter("teamHome"));

                for (Player p : players) {
                    if (!p.getName().equals("")) {


            %>
            <li style="margin: 20px 0">
                <form action="HockeyLeagueServlet" method="GET">
                    <%=p.getName()%> 

                    <input type="submit" name="action" value="Delete Player" style="float: right; margin-right: 800px; display:inline-block;">
                    <input type="submit" name="action" value="Edit Player" style="float: right; display:inline-block;">
                    <input type="hidden" name="ID" value="<%=p.getID()%>">
                </form>
            </li>
            <%
                    }
                }
            %>
        </ol>

        <form style="display:inline-block;" action="addPlayer.jsp" method="GET">

            <input type="submit" value="Add Player">

        </form>

        <form style="display:inline-block;" action="index.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>
    </body>
</html>
