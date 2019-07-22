/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import data.Client;
import data.ClientDAO;
import data.DBManager;
import data.Hall;
import data.HallDAO;
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
@WebServlet(urlPatterns = {"/RoseBanquetHallServlet"})
public class RoseBanquetHallServlet extends HttpServlet {

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
                case "Register Hall": {
                    Hall hall = new Hall();
                    hall.setName(request.getParameter("name").replace("'", "&apos;"));
                    HallDAO HDAO = new HallDAO();
                    String sql = "SELECT * FROM dbRoseBanquetHall.Hall WHERE HallName='"
                            + request.getParameter("name").replace("'", "&#39;") + "'";
                    DBManager dbm = new DBManager();
                    ResultSet rs = dbm.executeQuery(sql);
                    if (rs.next()) {
                        request.setAttribute("Error", "Hall Already Exists!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("addHall.jsp");
                        reqDispatcher.forward(request, response);
                    } else if (hall.getName().equals("")) {

                        request.setAttribute("Error", "Missing Required Fields!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("addHall.jsp");
                        reqDispatcher.forward(request, response);
                    } else {
                        HDAO.createHall(hall);
                    }
                    response.sendRedirect("index.jsp");
                    break;
                }
                case "Delete Hall": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    request.setAttribute("ID", ID);
                    RequestDispatcher reqDispatcher = request.getRequestDispatcher("deleteHalls.jsp");
                    reqDispatcher.forward(request, response);
                    break;
                }
                case "Delete": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    HallDAO HDAO = new HallDAO();
                    String sql = "DELETE FROM dbRoseBanquetHall.Booking WHERE HallID='" + ID + "'";
                    DBManager dbm = new DBManager();
                    dbm.executeUpdate(sql);
                    HDAO.deleteHall(ID);
                    response.sendRedirect("HallAdmin.jsp");
                    break;
                }
                case "Edit Hall": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    request.setAttribute("ID", ID);
                    RequestDispatcher reqDispatcher = request.getRequestDispatcher("editHall.jsp");
                    reqDispatcher.forward(request, response);
                    break;
                }
                case "Save": {
                    String name = request.getParameter("name").replace("'", "&#39;");
                    int Id = Integer.parseInt(request.getParameter("Id"));
                    String sql = "SELECT * FROM dbRoseBanquetHall.Hall WHERE HallName='"
                            + request.getParameter("name").replace("'", "&#39;") + "'";
                    DBManager dbm = new DBManager();
                    ResultSet rs = dbm.executeQuery(sql);
                    HallDAO HDAO = new HallDAO();
                    if (rs.next()) {
                        request.setAttribute("Error", "Hall Already Exists!");
                        request.setAttribute("ID", Id);
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("editHall.jsp");
                        reqDispatcher.forward(request, response);
                    } else if (name.equals("")) {
                        request.setAttribute("ID", Id);
                        request.setAttribute("Error", "Missing Required Fields!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("editHall.jsp");
                        reqDispatcher.forward(request, response);
                    } else {
                        HDAO.updateHall(Id, name);
                    }
                    response.sendRedirect("HallAdmin.jsp");
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
