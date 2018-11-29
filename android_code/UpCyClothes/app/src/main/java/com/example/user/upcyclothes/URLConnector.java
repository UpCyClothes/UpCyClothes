package com.example.user.upcyclothes;


import android.util.Log;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import android.webkit.CookieManager;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.List;
import java.util.Map;

/**
 * Created by jinhee on 2018-10-05.
 */

public class URLConnector extends Thread {

    private String result;
    private String URL;
    private String postParameters;
    private String sessID;
    String cookieString;
    private boolean forLogin=false;

    public URLConnector(String url, String phpName, String postpara) {
        URL = url+phpName;
        Log.v("url : ", URL);
        postParameters = postpara;
        Log.v("post","url");
        this.forLogin=true;
    }
    public URLConnector(String url, String sessID) {
        URL = url;
        postParameters=null;
        this.sessID=sessID;
        Log.v("세션있는","url");
    }
    public URLConnector(String url, String phpName, String postpara, boolean forLogin) {
        URL = url+phpName;
        postParameters = postpara;
        Log.v("파라미터",postParameters);
        Log.v("post","url에 로그인인지 들어옴");
        this.forLogin=forLogin;
    }

    @Override
    public void run() {
        final String output = request(URL);
        result = output;
    }

    public String getResult() {
        return result;
    }

//    protected void saveCookie(HttpURLConnection conn){
//        Log.e("쿠키저장함수","function in");
//
//            Map<String, List<String>> imap = conn.getHeaderFields( ) ;
//            Log.v("셋쿠키 key 있음? ",(imap.containsKey("Set-Cookie"))+"");
//            if( imap.containsKey( "Set-Cookie" ) )
//            {
//                List<String> lString = imap.get( "Set-Cookie" ) ;
//                for( int i = 0 ; i < lString.size() ; i++ ) {
//                    m_cookies += lString.get( i ) ;
//                }
//                Log.e("쿠키",m_cookies);
//                m_session = true ;
//            } else {
//
//                Log.e("쿠키","No  쿠키쿠키");
//                m_session = false ;
//            }
//
//     //  Log.e("쿠키저장함수",m_cookies);
//        Log.e("쿠키저장함수","function out");
//
//    }

    protected String request(String urlStr) {
        String key="";
        try {
            URL url = new URL(urlStr);
            HttpURLConnection conn = (HttpURLConnection) url.openConnection();
            ///추가된 부분
            ///로그인다음 홈으로 갓다가 온 경우는 셋쿠키를 해주고 그냥 홈인 경우는 셋쿠키 할 필요 없다.

            if(sessID!=null){
                //셋쿠키 해주셈
                conn.setRequestProperty("Cookie",this.sessID);
                Log.v("셋쿠키했더","ㅋㅋㅋ");
            }
            //conn.setRequestProperty("Content-Type", "application/json");
            conn.setReadTimeout(5000);
            conn.setConnectTimeout(10000);
            conn.setRequestMethod("POST");
            conn.setDoOutput(true);
            //conn.setDoInput(true);

            OutputStream outputStream = conn.getOutputStream();

            if(postParameters!=null){ // POST가 있으면
                outputStream.write(postParameters.getBytes("UTF-8"));
                // Log.v("너 들어갔니?",postParameters);
            }

            outputStream.flush();
            outputStream.close();


            //  saveCookie(conn);


            //맨처음 로그인할때
            if(sessID==null && forLogin) {

                Log.v("맨 처음 로그인할때", "11");
                for (int i = 1; (key = conn.getHeaderFieldKey(i)) != null; i++) {
                    if (key.equalsIgnoreCase("Set-Cookie")) {
                        cookieString = conn.getHeaderField(key);
                        cookieString = cookieString.substring(0, cookieString.indexOf(";"));
                    }
                }
                Log.v("현재 쿠키스트링 저장함", cookieString);
            }

            int resCode = conn.getResponseCode();
            ///
            Log.v("리스펀스코드는", resCode + "입니다.");

            if(sessID!=null){
                return "OK";
            }

            InputStream inputStream;
            if (resCode == HttpURLConnection.HTTP_OK) {
                inputStream = conn.getInputStream();
            } else {
                inputStream = conn.getErrorStream();
            }
            InputStreamReader inputStreamReader = new InputStreamReader(inputStream, "UTF-8");
            BufferedReader reader = new BufferedReader(inputStreamReader);

            StringBuilder builder = new StringBuilder();
            String str;
            while ((str = reader.readLine()) != null) {       // 서버에서 라인단위로 보내줄 것이므로 라인단위로 읽는다
                builder.append(str + "\n");
                //   Log.v("제발",str);
                // View에 표시하기 위해 라인 구분자 추가

            }
            reader.close();

            // Log.v("서버에서 온 json은", builder.toString() + "입니다.");

            if(forLogin==true){
                return builder.toString()+"&"+ cookieString;
            }
            else return builder.toString();

            //return builder.toString()+"&"+ cookieString;
//새로운 출력부분
//            String res=null;
//            StringBuffer sb = new StringBuffer();
//            BufferedReader br = new BufferedReader(new InputStreamReader(inputStream));
//            String inputLine="";
//            while ((inputLine=br.readLine())!=null){
//                sb.append(inputLine);
//                Log.v("들어가자 ",inputLine+"제발");
//            }
//            res=sb.toString();
//            Log.v("inputstream 결과 ",res+"입니다.");
//            if(inputStream!=null){
//                try{
//                    inputStream.close();
//                }
//                catch (IOException e){
//                    Log.i("ERROR","Error closing InputStream");
//                }
//            }
//            br.close();
//            inputStream.close();
//            conn.disconnect();
//

        } catch(Exception ex){
            Log.e("SampleHTTP", "Exception in processing response.", ex);
            ex.printStackTrace();
            return new String("Error: " + ex.getMessage());

        }


    }
    ////

}
