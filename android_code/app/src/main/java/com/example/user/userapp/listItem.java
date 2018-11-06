package com.example.user.userapp;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.LinearLayout;
import android.widget.TextView;

/**
 * Created by jinhee on 2018-11-01.
 */

public class listItem extends LinearLayout {

    TextView nameTV;

    public listItem(Context con){
        super(con);
        init(con);
    }
    public void init(Context con){
        View view= LayoutInflater.from(con).inflate(R.layout.listitem,this);

        nameTV=(TextView)findViewById(R.id.nameTV);
    }
    public void setData(String name){
        nameTV.setText(name);
    }

}