package com.example.user.upcyclothes;


import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;

public class DetailMaterial extends AppCompatActivity {
    String id;
    String name;
    String remainAmount;
    String url;
    TextView itemAmount;
    int cnt = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_material);
        Intent intent = getIntent();

        id = intent.getStringExtra("item id");
        name = intent.getStringExtra("item name");
        remainAmount = intent.getStringExtra("item remain amount");
        url = intent.getStringExtra("item url");
        ImageView thumb = (ImageView) findViewById(R.id.thumbs);
        Glide.with(this).load(url).into(thumb);
        //이미지 세팅
        TextView itemName = (TextView) findViewById(R.id.nameTV);
        itemName.setText(name);
        final TextView remainAmountTV = (TextView) findViewById(R.id.remainAmountTV);
        remainAmountTV.setText(remainAmount + "KG");
        itemAmount = (TextView) findViewById(R.id.amountET);
        cnt = Integer.parseInt(itemAmount.getText().toString());
        ImageView minusBtn = (ImageView) findViewById(R.id.minusBtn);
        minusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //수량을 줄인다.
                if (cnt > 0) {
                    cnt--;
                    itemAmount.setText(cnt + "");
                }else {
                    Toast.makeText(getApplicationContext(), "수량은 0보다 작을 수 없습니다.", Toast.LENGTH_LONG).show();
                    return;
                }
            }
        });

        ImageView plusBtn = (ImageView) findViewById(R.id.plusBtn);
        plusBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //수량을 늘린다.
                if(Integer.parseInt(remainAmount)>cnt){

                    cnt++;
                    itemAmount.setText(cnt + "");
                }
                else {
                    Toast.makeText(getApplicationContext(), "제품의 남은 수량을 넘을 수 없습니다.", Toast.LENGTH_LONG).show();
                    return;
                }
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
                if(MainActivity.userID==null) {
                    Intent intent = new Intent(DetailMaterial.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    //마이페이지 고고
                    Intent intent = new Intent(DetailMaterial.this, MypageActivity.class);
                    //intent.putExtra("sauce name",name );
                    //intent.putExtra("userID",userID);
                    startActivity(intent);
                }
            }
        });
        cartBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(MainActivity.userID==null) {
                    Intent intent = new Intent(DetailMaterial.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    Intent intent = new Intent(DetailMaterial.this, MycartActivity.class);
                    startActivity(intent);
                }
            }
        });

        Button orderBtn = (Button) findViewById(R.id.orderBtn);


        orderBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                /*Go to Next Activity*/if (MainActivity.userID == null) {
                    //로그인이 필요한 서비스입니다. 창 띄워주기.
                    Log.v("userid는  ",  "없다.");
                    new android.app.AlertDialog.Builder(DetailMaterial.this)
                            .setIcon(android.R.drawable.ic_dialog_alert)
                            .setTitle("알림")
                            .setMessage("로그인이 필요한 서비스입니다.")
                            .setPositiveButton("Yes", new DialogInterface.OnClickListener() {
                                @Override
                                public void onClick(DialogInterface dialog, int which) {
                                    Intent intent = new Intent(DetailMaterial.this, LoginActivity.class);
                                    startActivityForResult(intent, 2000);
                                }
                            })
                            .show();

                } else if (cnt == 0) {
                    Log.v("수량이  ",cnt+"이다.");
                    android.support.v7.app.AlertDialog.Builder builder = new android.support.v7.app.AlertDialog.Builder(DetailMaterial.this);
                    AlertDialog dialog = builder.setMessage("수량이 0이면 주문을 할 수 없습니다!").setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialogInterface, int i) {

                        }
                    }).create();
                    dialog.show();
                }
                else {
                    Intent intent = new Intent(DetailMaterial.this, OrderActivity.class);
                    intent.putExtra("type", true);
                    intent.putExtra("item id", id);
                    intent.putExtra("item name", name);
                    intent.putExtra("item cnt", cnt);
                    intent.putExtra("totPrice", 2500);
                    intent.putExtra("url", url);
                    startActivity(intent);

                }
            }

        });
        //현재 아이템의 수량이 0이면 장바구니와 주문버튼 비활성화
        if (Integer.parseInt(remainAmount) == 0) {
            orderBtn.setEnabled(false);
        }
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data){
        if(resultCode== RESULT_OK){
            //요청할 때 보낸 요청코드 (3000)
            switch(requestCode) {
                case 2000:
                    Log.v("detailmeterial","in");
                    break;
            }
        }
    }
}
