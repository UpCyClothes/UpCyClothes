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

public class MessengerActivity extends AppCompatActivity {
    private String user_ID;
    private ListView mListView;
    private String[] messengerID;
    private String[] messengerDate;
    private String[] content;
    private String[] FromID;
    private String[] ToID;
    private String[] unread;

    private String[] designerID;
    private String[] totUnread;
    private boolean[] unread4Designer;

    private ListView.OnItemClickListener listviewOnItemClickListener
            = new ListView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

            Intent intent = new Intent(MessengerActivity.this, DetailCommunity.class);

            intent.putExtra("messenger id",messengerID[arg2]);
            intent.putExtra("date",messengerDate[arg2]);
            intent.putExtra("content",content[arg2]);
            intent.putExtra("FromID",FromID[arg2]);
            intent.putExtra("ToID",ToID[arg2]);
            intent.putExtra("unread",unread[arg2]);
            startActivity(intent);
            //컨텐트내용은 다음에서 받을거임.
        }
    };
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_messenger);
        //여기도 로그인이 되어있는지 체크해야함.
        TextView idTV = (TextView)findViewById(R.id.idTV);

        if(MainActivity.userID==null){
            //로그인이 필요한 서비스입니다. 창 띄워주기.
            Log.v("userid는  ",user_ID+"없다.");
            new android.app.AlertDialog.Builder(this)
                    .setIcon(android.R.drawable.ic_dialog_alert)
                    .setTitle("알림")
                    .setMessage("로그인이 필요한 서비스입니다.")
                    .setPositiveButton("Yes", new DialogInterface.OnClickListener()
                    {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            Intent intent = new Intent(MessengerActivity.this, LoginActivity.class);
                            startActivity(intent);
                            finish();
                        }
                    })
                    .show();

        }
        else {
            user_ID=MainActivity.userID;
            idTV.setText(user_ID);
            mListView = (ListView) findViewById(R.id.listview);
            LetsConnect letsConnect = new LetsConnect();
            letsConnect.getItemInfo();

            dataSetting();
        }
    }
    private void dataSetting(){
        //여기서 서버 값 정리해서 보내주기
       int cnt=0;
       unread4Designer=new boolean[designerID.length];
        for(int i=0;i<designerID.length;i++){
            if(Integer.parseInt(totUnread[i])==0){
                unread4Designer[i]=false;
            }
            else {
                unread4Designer[i]=true;
            }
        }

        messAdapter mAdapter= new messAdapter(designerID,unread4Designer);
        //정보를 보내줍니다.

        mListView.setAdapter(mAdapter);
    }
    private class LetsConnect {

        protected void getItemInfo( ) {
            //from or to에 user_id가 있는 모든 컬럼 다 가져오기
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/getDesignerList.php", "user_ID="+user_ID,false);

            Log.v("task",task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            Log.v("result",result);
            parsingItem(result);
        }

        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    messengerID=new String[Integer.parseInt(num)];
                    designerID=new String[Integer.parseInt(num)];
                    totUnread=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);
                        messengerID[i]=jo.getString("messengerID");
                        designerID[i]=jo.getString("designerID");
                        totUnread[i]=jo.getString("totUnread");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }
}
