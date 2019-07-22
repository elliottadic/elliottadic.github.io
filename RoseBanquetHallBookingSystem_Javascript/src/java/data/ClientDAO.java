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
public class ClientDAO {

    public void createClient(Client client) {
        String sql = "INSERT INTO dbRoseBanquetHall.Client(ClientName, ClientCreditCard)\n"
                + "values ('" + client.getName() + "', '" + client.getCreditCard() + "')";

        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
    
     public ArrayList<Client> retrieveClients(){
        ArrayList<Client> clients = new ArrayList<Client>();
        try{
            DBManager dbm = new DBManager();
            
           
            String sql = "SELECT * FROM dbRoseBanquetHall.Client";
            ResultSet rs = dbm.executeQuery(sql);
            while(rs.next()){
                Client client = new Client();
                client.setID(rs.getInt("ClientID"));
                client.setName(rs.getString("ClientName"));
                client.setCreditCard(rs.getString("ClientCreditCard"));
                clients.add(client);
            }
        }catch(Exception e){
            System.out.println("Error retrieving clients: "+e);
        }
        return clients;
    }
    
    public void deleteClient(int ID){
        String sql = "DELETE FROM dbRoseBanquetHall.Client WHERE ClientID="+ID;
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
    
    public void updateClient(int Id, String name, String number){
        String sql = "UPDATE dbRoseBanquetHall.Client SET ClientName='"+name+"', "
                + "ClientCreditCard='"+number+"' WHERE ClientID=" + Id ;
        
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }

}
