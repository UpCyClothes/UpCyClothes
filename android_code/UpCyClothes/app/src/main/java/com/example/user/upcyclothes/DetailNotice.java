package com.example.user.upcyclothes;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;

public class DetailNotice extends AppCompatActivity {
    String subject;
    String date;
    String content;
    String category;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_notice);
        Intent intent = getIntent();
        category=intent.getStringExtra("category");
        subject=intent.getStringExtra("item name");
        date=intent.getStringExtra("item date");
        content=intent.getStringExtra("item content");

        Button noticeBtn= (Button)findViewById(R.id.noticeBtn);
        Button faqBtn= (Button)findViewById(R.id.faqBtn);

        if(category.equals("notice")){
            faqBtn.setTextColor(getResources().getColor(R.color.colorGray));
        }
        else {
            noticeBtn.setTextColor(getResources().getColor(R.color.colorGray));
        }

        TextView subjectTV=(TextView)findViewById(R.id.subjectTV);
        TextView dateTV=(TextView)findViewById(R.id.dateTV);
        TextView contentTV=(TextView)findViewById(R.id.contentTV);
        subjectTV.setText(subject);
        dateTV.setText(date);
        contentTV.setText(content);
    }
}
