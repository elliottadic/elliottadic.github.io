<%-- 
    Document   : addPlayer
    Created on : 23-Mar-2018, 3:02:27 AM
    Author     : elliottadic
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Player</title>
    </head>
    <body>
        <h1>HOCKEY LEAGUE</h1>
        <form action="HockeyLeagueServlet" method="GET" >
            <table>
                <tr> 
                    <td>Name</td> <td><input type="text" name="name"></td>
                </tr>  
                <tr> 
                    <td>Address</td> <td> <input type="text" name="address"></td>
                </tr>  
                <tr> 
                   <td> Team </td> <td><select name="team"> <option>Red</option><option>Blue</option></select></td>
                </tr> 
                <tr> 
                   <td> Role</td> <td> <select name="role"> <option>Goalie</option><option>Defense</option><option>Forward</option></select></td>
                </tr>  
                <tr> 
                   <td> Active</td> <td><input type="checkbox" name="active"></td>
                </tr>  

            </table>
            <input type="submit" name="action" value="Add Player" style="display: inline-block">
            <input type="submit"  name="action" value="Cancel" style="display: inline-block"> 
        </form>
        
    </body>
</html>
