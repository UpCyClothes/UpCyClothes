package com.example.user.upcyclothes;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;

import com.bumptech.glide.Glide;

public class cartItem extends AppCompatActivity {

    TextView itemNameTV;
    TextView priceTV;
    TextView amountTV;
    ImageView itemImg;
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //setContentView(R.layout.activity_main);

        itemNameTV=(TextView)findViewById(R.id.itemNameTV);
        priceTV=(TextView)findViewById(R.id.priceTV);
        amountTV=(TextView)findViewById(R.id.amountTV);
        itemImg=(ImageView)findViewById(R.id.itemImg);

//
    }




}