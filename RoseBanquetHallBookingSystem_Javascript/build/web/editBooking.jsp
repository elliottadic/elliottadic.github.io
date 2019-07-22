<%-- 
    Document   : editBooking
    Created on : 19-Apr-2018, 4:05:54 AM
    Author     : elliottadic
--%>

<%@page import="data.ClientDAO"%>
<%@page import="data.Client"%>
<%@page import="java.util.ArrayList"%>
<%@page import="data.Hall"%>
<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page import="data.HallDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit Booking</title>
    </head>
    <body>
        <%! String Id = "";%>
        <%! String error = "";%>
        <%! String hiddenNumber = "";%>
        <%! String date = "";%>
        <%! String CurrentClient = "";%>
        <%! String CurrentHall = "";%>
        <%! String CurrentClientID = "";%>
        <%! String CurrentHallID = "";%>
        <%! String CurrentHN = "";%>
        <%! String CurrentCC = "";%>


        <%
            Id = String.valueOf(request.getAttribute("ID"));
            String sql = "SELECT * FROM (dbRoseBanquetHall.Booking INNER JOIN Client ON Client.ClientID = Booking.ClientID INNER JOIN Hall ON Hall.HallID = Booking.HallID) WHERE BookingID= " + Id;
            DBManager dbm = new DBManager();
            ResultSet rs = dbm.executeQuery(sql);

            if (rs.next()) {
                date = rs.getString("Date");
                CurrentClient = rs.getString("ClientName");
                CurrentHall = rs.getString("HallName");
                CurrentClientID = rs.getString("ClientID");
                CurrentHallID = rs.getString("HallID");
                CurrentCC = rs.getString("ClientCreditCard");
                
                char[] CurrentnumberChars = CurrentCC.toCharArray();

                            CurrentnumberChars[0] = '*';
                            CurrentnumberChars[1] = '*';
                            CurrentnumberChars[2] = '*';
                            CurrentnumberChars[3] = '*';
                            CurrentnumberChars[4] = '*';
                            CurrentnumberChars[5] = '*';
                            CurrentnumberChars[6] = '*';
                            CurrentnumberChars[7] = '*';

                            CurrentHN = String.valueOf(CurrentnumberChars);
            }
            error = String.valueOf(request.getAttribute("Error"));

            if (error == "null") {
                error = "";
            } else {
                error = String.valueOf(request.getAttribute("Error"));
            }


        %>

        <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <h1>Edit Booking</h1>
        <form action="RoseBanquetHallServletThree" method="GET">

            <br>Select Hall: <select name="halls">
                <option value="<%=CurrentHallID%>"><%=CurrentHall%> </option>
                <%                HallDAO HDAO = new HallDAO();
                    ArrayList<Hall> Halls = HDAO.retrieveHalls();

                    for (Hall h : Halls) {
                        if (!h.getName().equals("") && !h.getName().equals(CurrentHall)) {
                %>
                <option value="<%=h.getID()%>"><%=h.getName()%> </option>
                <%
                        }
                    }

                %>
            </select>
            <br>Select Client: <select name="client">
                <option value="<%=CurrentClientID%>">Name: <%=CurrentClient%> ____ Card#:<%=CurrentHN%> </option>
                <%                ClientDAO CDAO = new ClientDAO();
                    ArrayList<Client> clients = CDAO.retrieveClients();

                    for (Client c : clients) {
                        if (!c.getName().equals("") && !c.getCreditCard().equals(CurrentCC)) {
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
            <br>Enter Date: <input type="date" name="date" value="<%= date%>"><br>
            <span style="color: Red;"> <%= error%> </span>
<input type="hidden" name="Id" value="<%= Id%>">
            <br><br><input type="submit" name="action" value="Save">
        </form>
        <br>
        <form style="display:inline-block;" action="index.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>
    </body>
</html>
