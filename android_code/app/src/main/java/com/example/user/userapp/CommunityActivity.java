package com.example.user.userapp;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.GridView;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class CommunityActivity extends AppCompatActivity {
    private String[] itemID;
    private String[] subject;
    private String[] content;
    private String[] updated;
    private String[] noticeImg;

    DisplayMetrics mMetrics;
    View v;

    private ListView.OnItemClickListener gridviewOnItemClickListener
            = new GridView.OnItemClickListener() {

        public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
                                long arg3) {

//            Toast.makeText(fragmentCloth.this.getContext(),
//                    sauce_list.get(arg2).toString(),
//                    Toast.LENGTH_LONG).show();
//            Intent intent = new Intent(getActivity(), DetailItem.class);
//
//            intent.putExtra("category","cloth");
//            intent.putExtra("item id",p_id_list[arg2]);
//            intent.putExtra("item name",p_name_list[arg2]);
//            intent.putExtra("item price",p_price_list[arg2]);
//            intent.putExtra("item url",p_url_list[arg2]);
//            intent.putExtra("item detail url",p_detailUrl_list[arg2]);
//            startActivity(intent);
        }
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_community);
        LetsConnect l= new LetsConnect();
        l.getItemInfo();
        //서버랑 통신해서 커뮤티니 정보를 얻어옵니다.
        ListView listview = (ListView)findViewById(R.id.listview);

        ListAdapter adapter= new ListAdapter(this.getApplicationContext(), subject);
        listview.setAdapter(adapter);

        listview.setOnItemClickListener(gridviewOnItemClickListener);
        mMetrics = new DisplayMetrics();
        getWindowManager().getDefaultDisplay().getMetrics(mMetrics);




    }
    private class LetsConnect {

        protected void getItemInfo( ) {
            URLConnector task = new URLConnector("https://upcyclothes.duckdns.org", "/android/communityInfo.php", "noticeType=3",false);

            Log.v("task",task.toString());
            task.start();
            try {
                task.join();
            } catch (InterruptedException e) {            }
            String result = task.getResult();
            Log.v("result",result);
            parsingItem(result);
            //Log.v("p_name",p_name_list[0]);
            //Log.v("p_name",p_name_list[1]);
            //Log.v("p_name",p_name_list[2]);
        }
        protected void parsingItem(String result) {//*****************이 메소드 전체

            Log.v("이제 아이템 파싱할거에요",result);
            try {
                if (result != null) {
                    JSONObject root = new JSONObject(result);
                    JSONArray ja = root.getJSONArray("results");
                    String num= root.getString("num_results");
                    itemID=new String[Integer.parseInt(num)];
                    subject=new String[Integer.parseInt(num)];
                    content=new String[Integer.parseInt(num)];
                    updated=new String[Integer.parseInt(num)];
                    noticeImg=new String[Integer.parseInt(num)];
                    for (int i = 0; i < ja.length(); i++) {
                        JSONObject jo =ja.getJSONObject(i);
                        itemID[i]=jo.getString("noticeID");
                        subject[i]=jo.getString("subject");
                        content[i]=jo.getString("content");
                        updated[i]=jo.getString("updated");
                        noticeImg[i]="https://upcyclothes.duckdns.org"+jo.getString("noticeImg");
                    }
                }

            }
            catch (JSONException e) {
                e.printStackTrace();
            }
        }
    }

}
