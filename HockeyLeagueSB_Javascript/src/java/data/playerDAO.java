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
public class playerDAO {
     public void createPlayer(Player player){
        String sql = "INSERT INTO dbhockeyleague.Players (playerName, playerAddress, teamID, playerRole, playerActiveStatus)\n" +
"values ('"+player.getName()+"', '"+player.getAddress()+"', '"+player.getTeam()+"', '"+player.getRole()+"', '"+player.getActive()+"')";
        
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
     
     public void updatePlayer(int Id, String name, String address, int team, String role, String active){
        String sql = "UPDATE dbhockeyleague.Players SET playerName='"+name+"', playerAddress='"+address+"', teamID="+team+", playerRole='"+role+"', playerActiveStatus='"+active+"' WHERE PlayerID=" + Id ;
        
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
     
     
     public void deletePlayer(int ID){
        String sql = "DELETE FROM dbhockeyleague.Players WHERE PlayerID="+ID;
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
     
     
     
      public ArrayList<Player> retrieveAllPlayers(String teamHome){
        ArrayList<Player> players = new ArrayList<Player>();
        try{
            DBManager dbm = new DBManager();
            //ResultSet rs = dbm.executeQuery("SELECT * FROM dbhockeyleague.Players");
           
            String sql = "SELECT * FROM (dbhockeyleague.Teams INNER JOIN Players ON Players.teamID = Teams.teamID) WHERE teamName='" + teamHome + "'";
            ResultSet rs = dbm.executeQuery(sql);
            while(rs.next()){
                Player player = new Player();
                player.setID(rs.getInt("PlayerID"));
                player.setName(rs.getString("playerName"));
                player.setAddress(rs.getString("playerAddress"));
                player.setTeam(rs.getString("teamID"));
                player.setRole(rs.getString("playerRole"));
                player.setActive(rs.getString("playerActiveStatus"));
                players.add(player);
            }
        }catch(Exception e){
            System.out.println("Error retrieving players: "+e);
        }
        return players;
    }
     
     
}