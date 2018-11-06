package com.example.user.userapp;


import android.content.Context;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;

import java.util.ArrayList;
/**
 * Created by jinhee on 2018-10-12.
 */

public class GridAdapter extends BaseAdapter {
    private Context context;
    private String[] itemName;
    private String[] itemPrice;
    private String[] itemURL;
    private boolean chkPrice=false;

    public  GridAdapter(Context con, String[] s1,String[] s2, String[] s3){
        this.context=con;
        this.itemName=s1;
        this.itemPrice=s2;
        this.itemURL=s3;
        chkPrice=true;
//        Log.v("itemname",itemName[0]);
//        Log.v("itemname",itemName[1]);
//        Log.v("itemname",itemName[2]);
    };
    public  GridAdapter(Context con, String[] s1,String[] s2){
        this.context=con;
        this.itemName=s1;
        this.itemURL=s2;
//        Log.v("itemname",itemName[0]);
//        Log.v("itemname",itemName[1]);
//        Log.v("itemname",itemName[2]);
    };


    public int getCount(){
        return itemName.length;
    }

    public String[] getItem(int pos){
        String[] item= new String[3];
        item[0]=itemName[pos];
        if(itemPrice!=null) {
            item[1] = itemPrice[pos];
        }
        item[2]=itemURL[pos];
        return item;
    }

    public  long getItemId(int pos){
        return pos;
    }

    public View getView(int pos, View convertView, ViewGroup parent){
        if(convertView == null){
            convertView= new Griditem(context);
        }
        //Log.v("setData : 네임",itemName[pos]+"가격"+itemPrice[pos]+"유알엘"+itemURL[pos]);
        if(chkPrice){
            ((Griditem)convertView).setData(itemName[pos],itemPrice[pos],itemURL[pos]);
        }
        else {
            ((Griditem)convertView).setData(itemName[pos],itemURL[pos]);
        }
        return convertView;
    }
}

