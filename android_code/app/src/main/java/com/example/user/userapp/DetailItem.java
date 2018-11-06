package com.example.user.userapp;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

public class DetailItem extends AppCompatActivity {
    String category;
    String id;
    String name;
    String price;
    String url;
    String detailUrl;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_item);
        Intent intent = getIntent();
        category=intent.getStringExtra("category");
        id=intent.getStringExtra("item id");
        name=intent.getStringExtra("item name");
        price=intent.getStringExtra("item price");
        url=intent.getStringExtra("item url");
        detailUrl=intent.getStringExtra("item detail url");

        ImageView thumb=(ImageView)findViewById(R.id.thumbs);
        Glide.with(this).load(url).into(thumb);
        //이미지 세팅
        TextView itemName= (TextView)findViewById(R.id.nameTV);
        itemName.setText(name);
        TextView itemPrice= (TextView)findViewById(R.id.priceTV);
        itemPrice.setText(price+"원");
        EditText itemAmount= (EditText)findViewById(R.id.amountET);
        Button orderBtn = (Button)findViewById(R.id.orderBtn);
        Button messengerBtn= (Button)findViewById(R.id.messengerBtn);
        ImageView detailImg = (ImageView)findViewById(R.id.detailImg);
        Glide.with(this).load(detailUrl).into(detailImg);
        detailImg.setScaleType(ImageView.ScaleType.CENTER);
        //이미지세팅

        orderBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/

                Intent intent = new Intent(DetailItem.this, LoginActivity.class);
                //intent.putExtra("amount",name );
                //intent.putExtra("userID",userID);
                startActivity(intent);
                finish();

            }
        });
        messengerBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Intent intent = new Intent(DetailItem.this, LoginActivity.class);
                //intent.putExtra("sauce name",name );
                //intent.putExtra("userID",userID);
                startActivity(intent);
                finish();

            }
        });
    }
}
