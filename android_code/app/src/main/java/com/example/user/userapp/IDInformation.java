package com.example.user.userapp;

public class IDInformation {
    public static String UserID;
    public  static int UserPW;

    IDInformation(){

    }
    IDInformation(String a, int b){
        this.UserID = a;
        this.UserPW = b;

    }

    public String getID(){
        return this.UserID;
    }

    public int getPW(){
        return this.UserPW;
    }
}
