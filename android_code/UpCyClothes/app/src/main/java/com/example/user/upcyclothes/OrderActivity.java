package com.example.user.upcyclothes;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

public class OrderActivity extends AppCompatActivity {
    private String productID;
    private String productName;
    private int productCount;
    private int productTotPrice;
    private String productURL;
    private TextView itemNameTV;
    private TextView amountTV;
    private TextView totPriceTV;
    private int cnt=0;
    private int price=0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order);
        Intent intent = getIntent();

        productID=intent.getStringExtra("item id");
        productName=intent.getStringExtra("item name");
        productCount=intent.getIntExtra("item cnt",0);
        productTotPrice=intent.getIntExtra("totPrice",0);
        productURL=intent.getStringExtra("item url");
        price=productTotPrice/productCount;
         ImageView itemImg = (ImageView) findViewById(R.id.itemImg);


        itemNameTV = (TextView) findViewById(R.id.itemNameTV);
       amountTV = (TextView) findViewById(R.id.amountTV);
       totPriceTV = (TextView) findViewById(R.id.totPriceTV);
        itemNameTV.setText(productName);
        amountTV.setText(productCount+"");
        totPriceTV.setText(productTotPrice+"");

        Glide.with(this).load(productURL).into(itemImg);

        cnt=Integer.parseInt(amountTV.getText().toString());
        ImageView minusBtn = (ImageView)findViewById(R.id.minusBtn);
        totPriceTV= (TextView)findViewById(R.id.totPriceTV);
        minusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //수량을 줄인다.
                if(cnt>0) {
                    cnt--;
                    amountTV.setText(cnt+"");
                    productTotPrice=price*cnt;
                    totPriceTV.setText("총 "+productTotPrice+"원");
                }
            }
        });
        ImageView plusBtn = (ImageView)findViewById(R.id.plusBtn);
        plusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //수량을 늘린다.
                cnt++;
                amountTV.setText(cnt+"");
                productTotPrice=price*cnt;
                totPriceTV.setText("총 "+productTotPrice+"원");
            }
        });

        Button orderBtn =(Button)findViewById(R.id.nextBtn);
        orderBtn.setOnClickListener(new Button.OnClickListener() {
            @Override
            public void onClick(View view) {

                    Intent intent = new Intent(OrderActivity.this, NextOrderActivity.class);
//                    intent.putExtra("item id",productID );
//                    intent.putExtra("item name",name );
//                    intent.putExtra("item cnt",cnt );
//                    intent.putExtra("totPrice",totPrice);
//                    intent.putExtra("url",url);
                    startActivity(intent);
                    finish();
                }

        });
    }
}
