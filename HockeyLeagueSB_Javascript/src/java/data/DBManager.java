/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package data;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
/**
 *
 * @author elliottadic
 */
public class DBManager {
    
    String conn = "jdbc:mysql://localhost:3306/dbhockeyleague";
    String user = "root";
    String pass = "mj2a56zx3d";
    
    public Connection getConnection(){
        Connection con = null;
        try{
            Class.forName("com.mysql.jdbc.Driver");
            con = DriverManager.getConnection(conn, user, pass);
        }catch(Exception e){
            System.out.println("Error getting connection: "+e);
        }
        return con;
    }
    
    public void executeUpdate(String sql){
        try{
            Connection con = getConnection();
            Statement st = con.createStatement();
            st.executeUpdate(sql);
        }catch(Exception e){
            System.out.println("Error executing update: "+e);
        }
    }
    
    public ResultSet executeQuery(String sql){
        ResultSet rs = null;
        try{
            Connection con = getConnection();
            Statement st = con.createStatement();
            rs = st.executeQuery(sql);
        }catch(Exception e){
            System.out.println("Error executing query: "+e);
        }
        return rs;
    }
            
    
}
