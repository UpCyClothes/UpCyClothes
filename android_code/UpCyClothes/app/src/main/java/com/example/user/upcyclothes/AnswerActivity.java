package com.example.user.upcyclothes;

import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class AnswerActivity extends AppCompatActivity {

    private String user_ID;
    private ListView mListView;


    private String[] messengerID;
    private String[] title;
    private String[] readmark;
    private boolean[] unread;

    private ListView.OnItemClickListener listviewOnItemClickListener
            = new ListView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

            Intent intent = new Intent(AnswerActivity.this, WriteAnswer.class);

            intent.putExtra("messengerID", messengerID[arg2]);
            startActivity(intent);
            finish();
            //컨텐트내용은 다음에서 받을거임.
        }
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_answer);

        LetsConnect letsConnect = new LetsConnect();
        //메신저디비에 현재 유저가 designerID로 있는 모든 제목을 보여주고, readmark==0이면 new를 띄워준다.
        user_ID=MainActivity.userID;
        TextView idTV = (TextView) findViewById(R.id.idTV);
        idTV.setText(LoginActivity.designNick+ " 에게 온 문의리스트");


        mListView = (ListView) findViewById(R.id.listview);
        mListView.setOnItemClickListener(listviewOnItemClickListener);

        letsConnect.getItemInfo();

        dataSetting();
    }

    private void dataSetting() {
        //여기서 서버 값 정리해서 보내주기
        unread=new boolean[title.length];

        for(int i=0;i<title.length;i++){
            if(Integer.parseInt(readmark[i])==0){
                unread[i]=true;
            }
            else {
                unread[i]=false;
            }
        }

        messAdapter mAdapter = new messAdapter(title, unread);
        //정보를 보내줍니다.

        mListView.setAdapter(mAdapter);
    }

    private class LetsConnect {

        protected void getItemInfo() {

            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/getAnswerList.php", "designerID="+LoginActivity.designNick, false);

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

        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요", result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num = root.getString("num_results");
                    messengerID = new String[Integer.parseInt(num)];
                    title = new String[Integer.parseInt(num)];
                    readmark = new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo = ja.getJSONObject(i);
                        messengerID[i] = jo.getString("messengerID");
                        title[i] = jo.getString("messageTitle");
                        readmark[i] = jo.getString("readmark");
                    }
                }

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
