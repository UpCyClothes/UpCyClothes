package com.example.user.upcyclothes;

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

import com.bumptech.glide.Glide;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class DetailMessage extends AppCompatActivity {

    private String productName;
    private String url;

    private String messengerID;
    private String subject;
    private String content;
    private String answer;
    private String readmark;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_message);
        Intent intent = getIntent();
        messengerID = (intent.getStringExtra("messengerID"));

        LetsConnect letsConnect = new LetsConnect();
        letsConnect.getItemInfo();

        ImageView thumbnail = (ImageView) findViewById(R.id.thumbnail);
        Glide.with(this).load(url).into(thumbnail);
        TextView itemInfo = (TextView) findViewById(R.id.itemInfo);
        itemInfo.setText(productName);
        final TextView subjectTV = (TextView) findViewById(R.id.subjectET);
        subjectTV.setText(subject);
        final TextView contentTV = (TextView) findViewById(R.id.contentET);
        contentTV.setText(content);
        final TextView answerTV = (TextView) findViewById(R.id.answerTV);
        if(answer!=null){
            answerTV.setBackgroundResource(R.drawable.green_rect);
            answerTV.setText(answer);
        }

        Button completeBtn = (Button) findViewById(R.id.completeBtn);
        completeBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //다하면 finish.
               finish();


        //
    }});

        //readmark==2이면 readmark=1로 바꿔준다.
        if(Integer.parseInt(readmark)==2){
        letsConnect.setReadmark();
        }
        //위에서 1로 바뀌어서 한 유저의 안읽은 메시지가 없으면 newMessage=0





    }
    private class LetsConnect {
        //서버에서 아이템이름, 아이템유알엘, 제목, 내용, 답변 받아오기.
        protected void getItemInfo() {
            //from or to에 user_id가 있는 모든 컬럼 다 가져오기
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/getMessageContent.php", "messengerID=" + messengerID, false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            Log.v("result", result);
            parsingItem(result);
        }
        protected void setReadmark() {
            //from or to에 user_id가 있는 모든 컬럼 다 가져오기
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/setReadmark.php", "messengerID=" + messengerID, false);

            Log.v("task", task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {
            }
            String result = task.getResult();
            Log.v("result", result);
        }
        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요", result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num = root.getString("num_results");
                   // messengerID = new String[Integer.parseInt(num)];
                   // title = new String[Integer.parseInt(num)];
                   // readmark = new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo = ja.getJSONObject(i);
                        productName = jo.getString("productName");
                        url ="https://upcyclothes.duckdns.org" + jo.getString("URL");
                        subject = jo.getString("messageTitle");
                        content = jo.getString("messageContent");
                        answer = jo.getString("answer");
                        readmark = jo.getString("readmark");
                    }
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

}
