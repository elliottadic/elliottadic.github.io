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
public class BookingDAO {

    public void createBooking(Booking booking) {
        String sql = "INSERT INTO dbRoseBanquetHall.Booking(HallID, ClientID, Date)\n"
                + "values ('" + booking.getHallID() + "', '" + booking.getClientID() + "', '" + booking.getDate() + "')";

        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
    
    public ArrayList<Booking> retrieveBookings(){
        ArrayList<Booking> bookings = new ArrayList<Booking>();
        try{
            DBManager dbm = new DBManager();
            
           
            String sql = "SELECT * FROM dbRoseBanquetHall.Booking";
            ResultSet rs = dbm.executeQuery(sql);
            while(rs.next()){
                Booking booking = new Booking();
                booking.setID(rs.getInt("BookingID"));
                booking.setHallID(rs.getInt("HallID"));
                booking.setClientID(rs.getInt("ClientID"));
                booking.setDate(rs.getString("Date"));
                bookings.add(booking);
            }
        }catch(Exception e){
            System.out.println("Error retrieving booking: "+e);
        }
        return bookings;
    }
    
    public void deleteBooking(int ID){
        String sql = "DELETE FROM dbRoseBanquetHall.Booking WHERE BookingID="+ID;
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
    
    public void updateBooking(int Id, int ClientId, int HallId, String date){
        String sql = "UPDATE dbRoseBanquetHall.Booking SET ClientID='"+ClientId+"', "
                + "HallID='"+HallId+"', Date='"+date+"' WHERE BookingID=" + Id ;
        
        DBManager dbm = new DBManager();
        dbm.executeUpdate(sql);
    }
    
}
