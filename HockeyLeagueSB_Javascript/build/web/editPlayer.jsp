<%-- 
    Document   : editPlayer
    Created on : 25-Mar-2018, 6:11:45 PM
    Author     : elliottadic
--%>

<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page import="data.playerDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit Player</title>
    </head>
    <body>
        <%! String Id = "";%>
        <%! String name = "";%>
        <%! String address = "";%>
        <%! String team = "";%>
        <%! String Oppteam = "";%>
        <%! String role = "";%>
        <%! String altrole1 = "";%>
        <%! String altrole2 = "";%>
        <%! String active = "";%>
        <%
            try {
                DBManager dbm = new DBManager();
                Id = String.valueOf(request.getAttribute("ID"));
                ResultSet rs = dbm.executeQuery("SELECT * FROM dbhockeyleague.Players WHERE PlayerID='" + Id + "'");
                while (rs.next()) {

                    name = rs.getString("playerName");
                    address = rs.getString("playerAddress");
                    team = rs.getString("teamID");
                    role = rs.getString("playerRole");
                    active = rs.getString("playerActiveStatus");
                    
                }
                if (team.equals("1")){
                    team = "Red";
                    Oppteam ="Blue";
                    }
                    else if (team.equals("2")){
                    team = "Blue";
                    Oppteam ="Red";
                    }
                    
                    if (role.equals("Defense")){
                    altrole1 = "Goalie";
                    altrole2 = "Forward";
                    }
                    else if (role.equals("Goalie")){
                    altrole1 = "Defense";
                    altrole2 = "Forward";
                    }
                    else if (role.equals("Forward")){
                    altrole1 = "Defense";
                    altrole2 = "Goalie";
                    }
                if (active.equals("Y")){
                active = "checked";
                }
                else if (active.equals("N")){
                active = "";
                }
                

            } catch (Exception e) {
                out.println("Error getting player info " + e);
            }


        %>
        <h1>HOCKEY LEAGUE</h1>
        <form action="HockeyLeagueServlet" method="GET" >
            <table>
                <tr> 
                    <td>Name</td> <td><input type="text" name="name" value="<%=name%>"></td>
                </tr>  
                <tr> 
                    <td>Address</td> <td> <input type="text" name="address" value="<%=address%>"></td>
                </tr>  
                <tr> 
                    <td> Team </td> <td><select name="team"> <option><%=team%></option><option><%= Oppteam%></option></select></td>
                </tr> 
                <tr> 
                    <td> Role</td> <td> <select name="role"> <option><%=role%></option><option><%=altrole1%></option><option><%=altrole2%></option></select></td>
                </tr>  
                <tr> 
                    <td> Active</td> <td><input type="checkbox" name="active" <%=active%> ></td>
                </tr>  

            </table>
            <input type="hidden" name ="Id" value="<%= Id%>">
            <input type="submit" name="action" value="Save" style="display: inline-block">
            <input type="submit"  name="action" value="Cancel" style="display: inline-block"> 
        </form>

    </body>
</html>
