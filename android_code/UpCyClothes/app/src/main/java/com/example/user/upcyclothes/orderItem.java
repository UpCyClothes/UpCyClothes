package com.example.user.upcyclothes;


import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.bumptech.glide.Glide;

/**
 * Created by jinhee on 2018-11-01.
 */

public class orderItem extends LinearLayout {

    TextView orderIDTV;
    TextView dateTV;
    ImageView itemImg;
    TextView itemNameTV;
    TextView itemPriceTV;
    TextView itemAmountTV;

    public orderItem(Context con){
        super(con);
        init(con);
    }
    public void init(Context con){
        View view= LayoutInflater.from(con).inflate(R.layout.activity_order_item,this);

        orderIDTV=(TextView)findViewById(R.id.orderIDTV);
        dateTV=(TextView)findViewById(R.id.dateTV);
        itemImg=(ImageView)findViewById(R.id.itemImg);
        itemNameTV=(TextView)findViewById(R.id.itemNameTV);
        itemPriceTV=(TextView)findViewById(R.id.priceTV);
        itemAmountTV=(TextView)findViewById(R.id.amountTV);


    }
    public void setData(String s1,String s2,String s3,String s4,String s5,String s6){
        orderIDTV.setText(s1);
        dateTV.setText(s2);
        Glide.with(this).load(s3).into(itemImg);
        itemNameTV.setText(s4);
        itemPriceTV.setText(s5);
        itemAmountTV.setText(s6);
    }

}