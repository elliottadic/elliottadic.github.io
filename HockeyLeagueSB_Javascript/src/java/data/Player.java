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
public class Player implements Serializable {
    private int ID;
    private String name;
    private String address;
    private String team;
    private String role;
    private String active;
    
    public Player(){
    
    }
   
    public int getID() {
        return ID;
    }

   
    public void setID(int ID) {
        this.ID = ID;
    }

  
    public String getName() {
        return name;
    }

    
    public void setName(String name) {
        this.name = name;
    }

    
    public String getAddress() {
        return address;
    }

    
    public void setAddress(String address) {
        this.address = address;
    }

    
    public String getTeam() {
        return team;
    }

   
    public void setTeam(String team) {
        
        this.team = team;
        
        if ((this.team).equals("Red")){
        this.team = "1";
        }
        else if ((this.team).equals("Blue")){
        this.team = "2";
        }
        
    }

    
    public String getRole() {
        return role;
    }

    
    public void setRole(String role) {
        this.role = role;
    }
    
     public String getActive() {
        
        return active;
    }

    
    public void setActive(String active) {
        this.active = active;
    }
}
