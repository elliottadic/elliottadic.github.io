package data;

import java.io.Serializable;
import java.util.Date;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author elliottadic
 */
public class Booking implements Serializable {
    private int ID;
    private int HallID;
    private int ClientID;
    private String Date;
    
    public Booking(){
    
    }

    /**
     * @return the ID
     */
    public int getID() {
        return ID;
    }

    /**
     * @param ID the ID to set
     */
    public void setID(int ID) {
        this.ID = ID;
    }

    /**
     * @return the HallID
     */
    public int getHallID() {
        return HallID;
    }

    /**
     * @param HallID the HallID to set
     */
    public void setHallID(int HallID) {
        this.HallID = HallID;
    }

    /**
     * @return the ClientID
     */
    public int getClientID() {
        return ClientID;
    }

    /**
     * @param ClientID the ClientID to set
     */
    public void setClientID(int ClientID) {
        this.ClientID = ClientID;
    }

    /**
     * @return the Date
     */
    public String getDate() {
        return Date;
    }

    /**
     * @param Date the Date to set
     */
    public void setDate(String Date) {
        this.Date = Date;
    }
}
