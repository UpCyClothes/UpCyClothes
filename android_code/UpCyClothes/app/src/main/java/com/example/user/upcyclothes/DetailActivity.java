package com.example.user.upcyclothes;


import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;

import org.json.JSONObject;

public class DetailActivity extends AppCompatActivity {
    String category;
    String id;
    String name;
    String designer;
    String price;
    String url;
    String detailUrl;
    String user_ID;
//"https://upcyclothes.duckdns.org" d
    TextView itemAmount;
    TextView totPriceTV;

    int cnt=0;
    int totPrice=0;
    private android.support.v7.app.AlertDialog dialog;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail);
        Intent intent = getIntent();
        category=intent.getStringExtra("category");
        id=(intent.getStringExtra("item id"));
        name=intent.getStringExtra("item name");
        designer=intent.getStringExtra("designer");
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
        itemAmount= (TextView)findViewById(R.id.amountET);
        cnt=Integer.parseInt(itemAmount.getText().toString());
        ImageView minusBtn = (ImageView)findViewById(R.id.minusBtn);
        totPriceTV= (TextView)findViewById(R.id.totPriceTV);
        minusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //수량을 줄인다.
                if(cnt>0) {
                    cnt--;
                    itemAmount.setText(cnt+"");
                    totPrice=(Integer.parseInt(price))*cnt;
                    totPriceTV.setText("총 "+totPrice+"원");
                }
            }
        });
        ImageView plusBtn = (ImageView)findViewById(R.id.plusBtn);
        plusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //수량을 늘린다.
                    cnt++;
                    itemAmount.setText(cnt+"");
                totPrice=(Integer.parseInt(price))*cnt;
                totPriceTV.setText("총 "+totPrice+"원");
            }
        });

        ImageView cartBtn=(ImageView)findViewById(R.id.cartImg);
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //장바구니에 넣는 역할을 한다.
                //사용자에게 먼저 로그인하라고 해야함.
                if(MainActivity.userID==null){
                    //로그인이 필요한 서비스입니다. 창 띄워주기.
                    Log.v("userid는  ",user_ID+"없다.");
                    new AlertDialog.Builder(DetailActivity.this)
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .setTitle("알림")
                            .setMessage("로그인이 필요한 서비스입니다.")
                            .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                            {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                    Intent intent = new Intent(DetailActivity.this, LoginActivity.class);
                                    startActivity(intent);
                                    finish();
                                }
                            })
                            .show();

                }
                else if(cnt==0){
                        Log.v("수량이  ",cnt+"이다.");
                        android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(DetailActivity.this);
                        dialog = builder.setMessage("수량이 0이면 장바구니에 추가할 수 없습니다!").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                            @Override
                            public void onClick(DialogInterface dialogInterface, int i) {

                            }
                        }).create();
                        dialog.show();
                    }
                    //서버에 넘겨줘야 할 정보 : productID, user_ID,designer,productName,count,price,productURL
                    else {
                    //로그인이 됐으면
                    user_ID=MainActivity.userID;
                    Response.Listener<String> responseListener = new Response.Listener<String>() {

                        @Override
                        public void onResponse(String response) {
                            try
                            {
                                Log.v("response",response);
                                JSONObject jsonResponse = new JSONObject(response);
                                boolean success = jsonResponse.getBoolean("success");
                                if (success) {
                                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(DetailActivity.this);
                                    dialog = builder.setMessage("장바구니에 추가되었습니다!").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                                        @Override
                                        public void onClick(DialogInterface dialogInterface, int i) {
                                            finish();
                                        }
                                    }).create();
                                    dialog.show();

                                }
                                else{
                                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(DetailActivity.this);
                                    dialog = builder.setMessage("Failed - Try One more!")
                                            .setNegativeButton("OK", null)
                                            .create();
                                    dialog.show();
                                }
                            }
                            catch (Exception e){
                                e.printStackTrace();
                            }
                        }
                    };
                    if(url.contains("https://upcyclothes.duckdns.org")){
                        url=url.replace("https://upcyclothes.duckdns.org","");
                    }
                    InsertRequest insertRequest = new InsertRequest(id, user_ID,designer,name,cnt+"",totPrice+"",url, responseListener);
                    RequestQueue queue = Volley.newRequestQueue(DetailActivity.this);
                    queue.add(insertRequest);


                }




            }
        });
        Button orderBtn = (Button)findViewById(R.id.orderBtn);
        Button messengerBtn= (Button)findViewById(R.id.messengerBtn);
        ImageView detailImg = (ImageView)findViewById(R.id.detailImg);
        Glide.with(this).load(detailUrl).into(detailImg);
        detailImg.setScaleType(ImageView.ScaleType.CENTER);
        //이미지세팅

        orderBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(MainActivity.userID==null){
                    //로그인이 필요한 서비스입니다. 창 띄워주기.
                    Log.v("userid는  ",user_ID+"없다.");
                    new AlertDialog.Builder(DetailActivity.this)
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .setTitle("알림")
                            .setMessage("로그인이 필요한 서비스입니다.")
                            .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                            {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                    Intent intent = new Intent(DetailActivity.this, LoginActivity.class);
                                    startActivity(intent);
                                    finish();
                                }
                            })
                            .show();

                }
                else if(cnt==0){
                    Log.v("수량이  ",cnt+"이다.");
                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(DetailActivity.this);
                    dialog = builder.setMessage("수량이 0이면 주문을 할 수 없습니다!").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {

                        }
                    }).create();
                    dialog.show();
                }
                else {
                    Intent intent = new Intent(DetailActivity.this, OrderActivity.class);

                    intent.putExtra("item id",id );
                    intent.putExtra("item name",name );
                    intent.putExtra("item cnt",cnt );
                    intent.putExtra("totPrice",totPrice);
                    intent.putExtra("url",url);
                    startActivity(intent);
                    finish();
                }
            }
        });
        messengerBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(MainActivity.userID==null){
                    //로그인이 필요한 서비스입니다. 창 띄워주기.
                    Log.v("userid는  ",user_ID+"없다.");
                    new AlertDialog.Builder(DetailActivity.this)
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .setTitle("알림")
                            .setMessage("로그인이 필요한 서비스입니다.")
                            .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                            {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                    Intent intent = new Intent(DetailActivity.this, LoginActivity.class);
                                    startActivity(intent);
                                    finish();
                                }
                            })
                            .show();

                }
                else {
                    Intent intent = new Intent(DetailActivity.this, QuestionActivity.class);
                    intent.putExtra("item id",id );
                    intent.putExtra("item name",name );
                    intent.putExtra("designer",designer);
                    intent.putExtra("url",url);
                    startActivity(intent);
                    finish();
                }
            }
        });
    }

}
