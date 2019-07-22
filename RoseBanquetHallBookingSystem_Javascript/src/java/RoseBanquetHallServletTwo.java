/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import data.Client;
import data.ClientDAO;
import data.DBManager;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.ResultSet;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author elliottadic
 */
@WebServlet(urlPatterns = {"/RoseBanquetHallServletTwo"})
public class RoseBanquetHallServletTwo extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");

        String action = request.getParameter("action");

        try {

            switch (action) {
                case "Register Client": {
                    Client client = new Client();
                    ClientDAO CDAO = new ClientDAO();
                    client.setName(request.getParameter("name").replace("'", "&#39;"));
                    client.setCreditCard(request.getParameter("number"));
                    String sql = "SELECT * FROM dbRoseBanquetHall.Client WHERE "
                            + "ClientName='" + request.getParameter("name").replace("'", "&#39;") + "' "
                            + "AND ClientCreditCard='" + request.getParameter("number")
                            + "' ";
                    DBManager dbm = new DBManager();
                    ResultSet rs = dbm.executeQuery(sql);
                    try {

                        Double.parseDouble(request.getParameter("number"));

                    } catch (NumberFormatException e) {
                        request.setAttribute("Error", "Invalid Number!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("registerClient.jsp");
                        reqDispatcher.forward(request, response);
                    }
                    if (rs.next()) {
                        request.setAttribute("Error", "Client With Card Number Already Exists!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("registerClient.jsp");
                        reqDispatcher.forward(request, response);
                    } else if (client.getCreditCard().length() < 12 || client.getCreditCard().length() > 19) {
                        request.setAttribute("Error", "Credit Card Number Length Invalid!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("registerClient.jsp");
                        reqDispatcher.forward(request, response);
                    } else if (client.getName().equals("")) {

                        request.setAttribute("Error", "Missing Required Fields!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("registerClient.jsp");
                        reqDispatcher.forward(request, response);
                    } else {
                        CDAO.createClient(client);
                    }
                    response.sendRedirect("index.jsp");
                    break;
                }

                case "Delete Client": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    request.setAttribute("ID", ID);
                    RequestDispatcher reqDispatcher = request.getRequestDispatcher("deleteClient.jsp");
                    reqDispatcher.forward(request, response);
                    break;
                }
                case "Delete": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    ClientDAO CDAO = new ClientDAO();
                    String sql = "DELETE FROM dbRoseBanquetHall.Booking WHERE ClientID='" + ID + "'";
                    DBManager dbm = new DBManager();
                    dbm.executeUpdate(sql);
                    CDAO.deleteClient(ID);
                    response.sendRedirect("ClientAdmin.jsp");
                    break;
                }
                case "Edit Client": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    request.setAttribute("ID", ID);
                    RequestDispatcher reqDispatcher = request.getRequestDispatcher("editClient.jsp");
                    reqDispatcher.forward(request, response);
                    break;
                }
                case "Save": {
                    String name = request.getParameter("name").replace("'", "&#39;");
                    String number = request.getParameter("number");
                    int Id = Integer.parseInt(request.getParameter("Id"));
                    String sql = "SELECT * FROM dbRoseBanquetHall.Client WHERE ClientName='"
                            + request.getParameter("name").replace("'", "&#39;") + "' AND ClientCreditCard='"
                            + request.getParameter("number") + "' ";
                    DBManager dbm = new DBManager();
                    ResultSet rs = dbm.executeQuery(sql);
                    ClientDAO CDAO = new ClientDAO();
                    try {

                        Double.parseDouble(request.getParameter("number"));

                    } catch (NumberFormatException e) {
                        request.setAttribute("Error", "Invalid Number!");
                        request.setAttribute("ID", Id);
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("editClient.jsp");
                        reqDispatcher.forward(request, response);
                    }
                    if (rs.next()) {
                        request.setAttribute("Error", "Client With Card Number Already Exists!");
                        request.setAttribute("ID", Id);
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("editClient.jsp");
                        reqDispatcher.forward(request, response);
                    } else if (number.length() < 12 || number.length() > 19) {
                        request.setAttribute("ID", Id);
                        request.setAttribute("Error", "Credit Card Number Length Invalid!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("editClient.jsp");
                        reqDispatcher.forward(request, response);
                    } else if (name.equals("")) {
                        request.setAttribute("ID", Id);
                        request.setAttribute("Error", "Missing Required Fields!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("editClient.jsp");
                        reqDispatcher.forward(request, response);
                    } else {
                        CDAO.updateClient(Id, name, number);
                    }
                    response.sendRedirect("ClientAdmin.jsp");
                    break;
                }
                default:
                    break;
            }

        } catch (Exception e) {
            System.out.println("Error executing query: " + e);
        }

    }
}
