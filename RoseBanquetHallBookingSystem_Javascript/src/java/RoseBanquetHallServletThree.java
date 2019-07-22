/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import data.Booking;
import data.BookingDAO;
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
@WebServlet(urlPatterns = {"/RoseBanquetHallServletThree"})
public class RoseBanquetHallServletThree extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        String action = request.getParameter("action");

        try {

            switch (action) {
                case "Register Booking": {
                    Booking booking = new Booking();
                    booking.setHallID(Integer.parseInt(request.getParameter("halls")));
                    booking.setClientID(Integer.parseInt(request.getParameter("client")));
                    booking.setDate(request.getParameter("date"));
                    BookingDAO BDAO = new BookingDAO();
                    String sql = "SELECT * FROM dbRoseBanquetHall.Booking WHERE HallID='"
                            + Integer.parseInt(request.getParameter("halls")) + "' AND Date='"
                            + request.getParameter("date") + "' ";
                    DBManager dbm = new DBManager();
                    ResultSet rs = dbm.executeQuery(sql);
                    if (rs.next()) {
                        request.setAttribute("Error", "Hall is Already Booked For That Date!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("bookHall.jsp");
                        reqDispatcher.forward(request, response);
                    } else if (request.getParameter("date").equals("")) {

                        request.setAttribute("Error", "Missing Required Fields!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("bookHall.jsp");
                        reqDispatcher.forward(request, response);
                    } else {
                        BDAO.createBooking(booking);
                    }
                    response.sendRedirect("index.jsp");
                    break;
                }
                case "Delete Booking": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    request.setAttribute("ID", ID);
                    RequestDispatcher reqDispatcher = request.getRequestDispatcher("deleteBooking.jsp");
                    reqDispatcher.forward(request, response);
                    break;
                }
                case "Delete": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    BookingDAO BDAO = new BookingDAO();
                    BDAO.deleteBooking(ID);
                    response.sendRedirect("BookingAdmin.jsp");
                    break;
                }
                case "Edit Booking": {
                    int ID = Integer.parseInt(request.getParameter("ID"));
                    request.setAttribute("ID", ID);
                    RequestDispatcher reqDispatcher = request.getRequestDispatcher("editBooking.jsp");
                    reqDispatcher.forward(request, response);
                    break;
                }
                case "Save": {
                    String date = request.getParameter("date");
                    int ClientId = Integer.parseInt(request.getParameter("client"));
                    int HallId = Integer.parseInt(request.getParameter("halls"));
                    int Id = Integer.parseInt(request.getParameter("Id"));

                    String sql = "SELECT * FROM dbRoseBanquetHall.Booking WHERE HallID='" + HallId
                            + "' AND Date='" + date + "' ";
                    DBManager dbm = new DBManager();
                    ResultSet rs = dbm.executeQuery(sql);
                    BookingDAO BDAO = new BookingDAO();
                    if (rs.next()) {
                        request.setAttribute("Error", "Hall is Already Booked For That Date!");
                        request.setAttribute("ID", Id);
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("editBooking.jsp");
                        reqDispatcher.forward(request, response);
                    } else if (date.equals("")) {
                        request.setAttribute("ID", Id);
                        request.setAttribute("Error", "Missing Required Fields!");
                        RequestDispatcher reqDispatcher = request.getRequestDispatcher("editBooking.jsp");
                        reqDispatcher.forward(request, response);
                    } else {
                        BDAO.updateBooking(Id, ClientId, HallId, date);
                    }
                    response.sendRedirect("BookingAdmin.jsp");
                    break;
                }
                default:
                    break;
            }

        } catch (Exception e) {
            System.out.println("Error executing query: " + e);
        }
    }

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

}
