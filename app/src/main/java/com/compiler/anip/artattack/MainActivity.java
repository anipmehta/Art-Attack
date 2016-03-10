package com.compiler.anip.artattack;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import android.app.Activity;
import android.app.DownloadManager;
import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.util.Log;
import android.view.Menu;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.Volley;
import com.compiler.anip.artattack.Utils.CustomRequest;

import org.json.JSONException;
import org.json.JSONObject;

public class MainActivity extends Activity {

    private TextView txtSpeechInput;
    RequestQueue queue;
    private ImageButton btnSpeak;
    private final int REQ_CODE_SPEECH_INPUT = 100;
    int xco=0,yco=0;
    String shape=null;
    int[] numbers;
    int radius=0;
    String text=null;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        queue= Volley.newRequestQueue(this);
        txtSpeechInput = (TextView) findViewById(R.id.txtSpeechInput);
        txtSpeechInput.setText("Which shape do you want to draw");
        btnSpeak = (ImageButton) findViewById(R.id.btnSpeak);
        numbers=new int[8];
        // hide the action bar
        getActionBar().hide();

        btnSpeak.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                promptSpeechInput("Enter Shape");
            }
        });

    }

    /**
     * Showing google speech input dialog
     * */
    private void promptSpeechInput(String message) {
        Intent intent = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL,
                RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());
        intent.putExtra(RecognizerIntent.EXTRA_PROMPT,
                message);
        try {
            startActivityForResult(intent, REQ_CODE_SPEECH_INPUT);
        } catch (ActivityNotFoundException a) {
            Toast.makeText(getApplicationContext(),
                    getString(R.string.speech_not_supported),
                    Toast.LENGTH_SHORT).show();
        }
    }

    /**
     * Receiving speech input
     * */
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        switch (requestCode) {
            case REQ_CODE_SPEECH_INPUT: {
                if (resultCode == RESULT_OK && null != data) {

                    ArrayList<String> result = data
                            .getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                    txtSpeechInput.setText(result.get(0));
                    if (result.get(0) == "Yes" || result.get(0) == "yes" || result.get(0) == "YES") {
                        promptSpeechInput("What do you want to draw next?");
                    } else if (result.get(0) == "No" || result.get(0) == "no" || result.get(0) == "No") {
                        final JSONObject obj = new JSONObject();
                        try {
                            obj.put("flag", 1);
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        CustomRequest request = new CustomRequest(Request.Method.POST, "http://anip.xyz/cd/delete.php", null, new Response.Listener<JSONObject>() {
                            @Override
                            public void onResponse(JSONObject response) {
                                try {

                                    if (response != null) {
                                        if (response.getString("message").equals("success")) {
                                            Toast.makeText(getApplicationContext(), "Your canvas is empty! Goodbye...", Toast.LENGTH_LONG).show();
                                            finish();
                                        } else {
                                            Toast.makeText(getApplicationContext(), "Error sending your command", Toast.LENGTH_LONG).show();
                                        }
                                    } else {
                                        Toast.makeText(getApplicationContext(), "Error sending your command", Toast.LENGTH_LONG).show();
                                    }
                                } catch (Exception e) {
                                    Toast.makeText(getApplicationContext(), "Error sending your command", Toast.LENGTH_LONG).show();
                                }

                            }
                        }, new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(getApplicationContext(), "Error sending your command", Toast.LENGTH_LONG).show();
                                error.printStackTrace();
                            }
                        }) {
                            @Override
                            protected Map<String, String> getParams() {
                                Map<String, String> params = new HashMap<String, String>();
                                params.put("data", obj.toString());
                                return params;
                            }
                        };
                    } else {

                        String temp = result.get(0);
                        Pattern p = Pattern.compile("\\d+");
                        Matcher m = p.matcher(temp);
                        int i = 0;
                        while (m.find()) {
                            numbers[i] = Integer.parseInt(m.group());
                            i++;
                        }
                        String[] parseString = temp.split(" ");

                        if (temp.contains("circle") || temp.contains("Circle") || temp.contains("CIRCLE")) {
                            xco = numbers[0];
                            yco = numbers[1];
                            radius = numbers[2];
                            shape = "circle";
                        }
                        else if (temp.contains("label")){
                            Pattern pattern = Pattern.compile("text ");
                            Matcher matcher = pattern.matcher(temp);
                            int index=0;
                            // Check all occurrences
                            while (matcher.find()) {
                                index=matcher.end();
                            }
                            text=temp.substring(index);
                            xco = numbers[0];
                            shape="label";
                            yco = numbers[1];
                            Log.i("hell",text);

                        }
                        final JSONObject obj = new JSONObject();
                        try {
                            obj.put("xco", xco);
                            obj.put("yco", yco);
                            obj.put("radius", radius);
                            obj.put("shape", shape);
                            obj.put("text",text);
                            CustomRequest request = new CustomRequest(Request.Method.POST, "http://anip.xyz/cd/insert.php", null, new Response.Listener<JSONObject>() {
                                @Override
                                public void onResponse(JSONObject response) {
                                    try {

                                        if (response != null) {
                                            if (response.getString("message").equals("success")) {
                                                Toast.makeText(getApplicationContext(), "You can see output on screen", Toast.LENGTH_LONG).show();
                                                promptSpeechInput("Do you want to draw more shape?");
                                            } else {
                                                Toast.makeText(getApplicationContext(), "Error sending your command", Toast.LENGTH_LONG).show();
                                            }
                                        } else {
                                            Toast.makeText(getApplicationContext(), "Error sending your command", Toast.LENGTH_LONG).show();
                                        }
                                    } catch (Exception e) {
                                        Toast.makeText(getApplicationContext(), "Error sending your command", Toast.LENGTH_LONG).show();
                                    }

                                }
                            }, new Response.ErrorListener() {
                                @Override
                                public void onErrorResponse(VolleyError error) {
                                    Toast.makeText(getApplicationContext(), "Error sending your command", Toast.LENGTH_LONG).show();
                                    error.printStackTrace();
                                }
                            }) {
                                @Override
                                protected Map<String, String> getParams() {
                                    Map<String, String> params = new HashMap<String, String>();
                                    params.put("data", obj.toString());
                                    return params;
                                }
                            };
                            queue.add(request);
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                    break;


                }
            }
        }

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

}
