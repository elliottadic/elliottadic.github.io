/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

import data.Player;
import data.playerDAO;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author elliottadic
 */
@WebServlet(urlPatterns = {"/HockeyLeagueServlet"})
public class HockeyLeagueServlet extends HttpServlet {

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
            if (action.equals("Add Player")) {
                String active = request.getParameter("active");
                if (active == null) {
                    active = "N";
                } else {
                    active = "Y";
                }
                Player player = new Player();
                player.setName(request.getParameter("name"));
                player.setAddress(request.getParameter("address"));
                player.setTeam(request.getParameter("team"));
                player.setRole(request.getParameter("role"));
                player.setActive(active);
                playerDAO PDAO = new playerDAO();
                PDAO.createPlayer(player);
                response.sendRedirect("index.jsp");

            }

            if (action.equals("Delete Player")) {
                int ID = Integer.parseInt(request.getParameter("ID"));

                request.setAttribute("ID", ID);
                RequestDispatcher reqDispatcher = request.getRequestDispatcher("deletePlayer.jsp");
                reqDispatcher.forward(request, response);

            }

            if (action.equals("Delete")) {
                int ID = Integer.parseInt(request.getParameter("ID"));
                playerDAO PDAO = new playerDAO();
                PDAO.deletePlayer(ID);
                response.sendRedirect("index.jsp");

            }

            if (action.equals("Edit Player")) {
                int ID = Integer.parseInt(request.getParameter("ID"));

                request.setAttribute("ID", ID);
                RequestDispatcher reqDispatcher = request.getRequestDispatcher("editPlayer.jsp");
                reqDispatcher.forward(request, response);

            }

            if (action.equals("Save")) {
                String active = request.getParameter("active");
                String team = request.getParameter("team");
                String name = request.getParameter("name");
                int Id = Integer.parseInt(request.getParameter("Id"));
                String address = request.getParameter("address");
                String role = request.getParameter("role");
                if (team.equals("Red")) {
                    team = "1";
                   
                } else if (team.equals("Blue")) {
                    team = "2";
                }
                 int teamN = Integer.parseInt(team);
                if (active == null) {
                    active = "N";
                } else {
                    active = "Y";
                }

                playerDAO PDAO = new playerDAO();
                PDAO.updatePlayer(Id, name, address, teamN, role, active);
                response.sendRedirect("index.jsp");

            }

            if (action.equals("Cancel")) {
                response.sendRedirect("index.jsp");

            }

        } catch (Exception e) {
            System.out.println("Error executing query: " + e);
        }

    }
}
