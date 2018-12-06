package com.example.user.upcyclothes;

import android.content.Intent;
import android.provider.ContactsContract;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

public class DetailCommunity extends AppCompatActivity {
    String subject;
    String date;
    String content;
    String category;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_community);
        Intent intent = getIntent();
        category=intent.getStringExtra("category");
        subject=intent.getStringExtra("item name");
        date=intent.getStringExtra("item date");
        content=intent.getStringExtra("item detail url");
        Log.v("컨텐트",content+"");
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
                    Intent intent = new Intent(DetailCommunity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    //마이페이지 고고
                    Intent intent = new Intent(DetailCommunity.this, MypageActivity.class);
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
                    Intent intent = new Intent(DetailCommunity.this, LoginActivity.class);
                    startActivityForResult(intent,2000);
                }
                else{
                    Intent intent = new Intent(DetailCommunity.this, MycartActivity.class);
                    startActivity(intent);
                }
            }
        });
        Button weeklyBtn= (Button)findViewById(R.id.weeklyBtn);
        Button campaignBtn= (Button)findViewById(R.id.campaignBtn);


        if(category.equals("weekly")){
            campaignBtn.setTextColor(getResources().getColor(R.color.colorGray));
        }
        else {
            weeklyBtn.setTextColor(getResources().getColor(R.color.colorGray));
        }
        TextView subjectTV=(TextView)findViewById(R.id.subjectTV);
        TextView dateTV=(TextView)findViewById(R.id.dateTV);
        ImageView Img=(ImageView)findViewById(R.id.Img);
        Glide.with(this).load(content).into(Img);
        Img.setScaleType(ImageView.ScaleType.CENTER);
        subjectTV.setText(subject);
        dateTV.setText(date);
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data){
        if(resultCode== RESULT_OK){
            //요청할 때 보낸 요청코드 (3000)
            switch(requestCode) {
                case 2000:
                    Log.v("detailCommunity","in");
                    break;
            }
        }
    }
}
