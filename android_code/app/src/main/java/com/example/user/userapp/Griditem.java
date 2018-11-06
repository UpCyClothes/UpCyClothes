package com.example.user.userapp;

import android.content.Context;
import android.graphics.Bitmap;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.bumptech.glide.Glide;

/**
 * Created by jinhee on 2018-10-11.
 */

public class Griditem extends LinearLayout {
    TextView itemName;
    TextView itemPrice;
    ImageView itemThumb;

    public Griditem(Context con){
        super(con);
        init(con);
    }
    public void init(Context con){
        View view= LayoutInflater.from(con).inflate(R.layout.griditem,this);
        itemName=(TextView)findViewById(R.id.productName);
        itemPrice=(TextView)findViewById(R.id.price);
        itemThumb=(ImageView)findViewById(R.id.imageView);

    }
    public void setData(String name,String pri, String url){

       // Log.v("setData2 : 네임",name+"가격"+pri+"유알엘"+url);
        itemName.setText(name);
        itemPrice.setText(pri);
        Glide.with(this).load(url).into(itemThumb);
       // Log.v("아이템데이터셋", "ㅎㅎ" );
    }
    public void setData(String name, String url){

        // Log.v("setData2 : 네임",name+"가격"+pri+"유알엘"+url);
        itemName.setText(name);
        Glide.with(this).load(url).into(itemThumb);
        // Log.v("아이템데이터셋", "ㅎㅎ" );
    }
}
