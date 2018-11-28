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
    private ImageView itemImg;
    private boolean type;
    private int price=0;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order);
        Intent intent = getIntent();

        type=intent.getBooleanExtra("type",false);
        productID=intent.getStringExtra("item id");
        productName=intent.getStringExtra("item name");
        productCount=intent.getIntExtra("item cnt",0);
        productTotPrice=intent.getIntExtra("totPrice",0);
        productURL=intent.getStringExtra("url");
        //Log.v("주문하기에 들어온 현재 url",productURL);
        price=productTotPrice/productCount;
        itemImg = (ImageView) findViewById(R.id.itemImg);

        itemNameTV = (TextView) findViewById(R.id.itemNameTV);
       amountTV = (TextView) findViewById(R.id.amountTV);
       totPriceTV = (TextView) findViewById(R.id.totPriceTV);
        itemNameTV.setText(productName);
        amountTV.setText(productCount+"");
        totPriceTV.setText(productTotPrice+"");

        Glide.with(this).load(productURL).into(itemImg);

        totPriceTV= (TextView)findViewById(R.id.totPriceTV);

        Button orderBtn =(Button)findViewById(R.id.nextBtn);
        orderBtn.setOnClickListener(new Button.OnClickListener() {
            @Override
            public void onClick(View view) {

                    Intent intent = new Intent(OrderActivity.this, NextOrderActivity.class);
//          구메자 이름, 연락처, 받는사람 정보 이름 주소 연락처 배송요청사항쓰기, 아이템이름 수량, ㄱ
                intent.putExtra("type",type);
                intent.putExtra("productID",productID );
                intent.putExtra("productName",productName );
                intent.putExtra("productCount",productCount+"");
                intent.putExtra("productTotPrice",productTotPrice);
                intent.putExtra("cartIdList","");
                    startActivity(intent);
                }

        });

        //툴바의 버튼
        // final ImageView alarmBtn= (ImageView) findViewById(R.id.alarmBtn);
        final ImageView cartBtn= (ImageView) findViewById(R.id.cartBtn);
        final ImageView personBtn= (ImageView) findViewById(R.id.personBtn);
        //새로운 문의가 있을 경우에 보여지고 없으면 안보여진다.

        //툴바 버튼리스너
        personBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/
                //userID= getIntent().getStringExtra("userID");
                //Log.v("userID",userID);

                //name = fname.getText().toString();

                    //마이페이지 고고
                    Intent intent = new Intent(OrderActivity.this, MypageActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);

            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                    Intent intent = new Intent(OrderActivity.this, MycartActivity.class);
                    startActivity(intent);

            }
        });
    }
}
