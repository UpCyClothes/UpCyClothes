package com.example.user.upcyclothes;

import android.content.Intent;
import android.provider.ContactsContract;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
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

        Button weeklyBtn= (Button)findViewById(R.id.weeklyBtn);
        Button campaignBtn= (Button)findViewById(R.id.campaignBtn);

//        if(category.equals("weekly")){
//            campaignBtn.setTextColor(getResources().getColor(R.color.colorGray));
//        }
//        else {
//            weeklyBtn.setTextColor(getResources().getColor(R.color.colorGray));
//        }

        TextView subjectTV=(TextView)findViewById(R.id.subjectTV);
        TextView dateTV=(TextView)findViewById(R.id.dateTV);
        ImageView Img=(ImageView)findViewById(R.id.Img);
        Glide.with(this).load(content).into(Img);
        Img.setScaleType(ImageView.ScaleType.CENTER);
        subjectTV.setText(subject);
        dateTV.setText(date);
    }
}
