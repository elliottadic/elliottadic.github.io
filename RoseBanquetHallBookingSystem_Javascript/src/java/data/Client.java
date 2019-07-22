package data;

import java.io.Serializable;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author elliottadic
 */
public class Client  implements Serializable {
    private int ID;
    private String Name;
    private String CreditCard;
    
    public Client(){
    
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
     * @return the Name
     */
    public String getName() {
        return Name;
    }

    /**
     * @param Name the Name to set
     */
    public void setName(String Name) {
        this.Name = Name;
    }

    /**
     * @return the CreditCard
     */
    public String getCreditCard() {
        return CreditCard;
    }

    /**
     * @param CreditCard the CreditCard to set
     */
    public void setCreditCard(String CreditCard) {
        this.CreditCard = CreditCard;
    }
}
