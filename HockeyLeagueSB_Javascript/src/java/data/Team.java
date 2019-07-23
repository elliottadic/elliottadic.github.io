/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package data;

import java.io.Serializable;

/**
 *
 * @author elliottadic
 */
public class Team implements Serializable {
    private int ID;
    private String teamName;
   
    
    public Team(){
    
    }
   
    public int getID() {
        return ID;
    }

   
    public void setID(int ID) {
        this.ID = ID;
    }

  
    public String getTeamName() {
        return teamName;
    }

  
}