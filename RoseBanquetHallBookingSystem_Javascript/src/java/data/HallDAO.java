/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package data;

import java.sql.ResultSet;
import java.util.ArrayList;

/**
 *
 * @author elliottadic
 */
public class HallDAO {
    public void createHall(Hall hall) {
        String sql = "INSERT INTO dbRoseBanquetHall.Hall(HallName)\n"
                + "values ('" + hall.getName() + "')";
        
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
    
    public ArrayList<Hall> retrieveHalls(){
        ArrayList<Hall> halls = new ArrayList<Hall>();
        try{
            DBManager dbm = new DBManager();
            
           
            String sql = "SELECT * FROM dbRoseBanquetHall.Hall";
            ResultSet rs = dbm.executeQuery(sql);
            while(rs.next()){
                Hall hall = new Hall();
                hall.setID(rs.getInt("HallID"));
                hall.setName(rs.getString("HallName"));
                halls.add(hall);
            }
        }catch(Exception e){
            System.out.println("Error retrieving Halls: "+e);
        }
        return halls;
    }
    
    public void deleteHall(int ID){
        String sql = "DELETE FROM dbRoseBanquetHall.Hall WHERE HallID="+ID;
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
    
    public void updateHall(int Id, String name){
        String sql = "UPDATE dbRoseBanquetHall.Hall SET HallName='"+name+"' WHERE HallID=" + Id ;
        
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
}
