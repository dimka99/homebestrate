package com.mortgageratehub.app;

import android.app.Application;
import androidx.work.Constraints;
import androidx.work.NetworkType;
import androidx.work.PeriodicWorkRequest;
import androidx.work.WorkManager;
import java.util.concurrent.TimeUnit;

public class MortgageRateHubApp extends Application {
    
    @Override
    public void onCreate() {
        super.onCreate();
        setupRateUpdateWorker();
    }

    private void setupRateUpdateWorker() {
        Constraints constraints = new Constraints.Builder()
                .setRequiredNetworkType(NetworkType.CONNECTED)
                .build();

        PeriodicWorkRequest rateUpdateWork =
                new PeriodicWorkRequest.Builder(RateUpdateWorker.class, 4, TimeUnit.HOURS)
                        .setConstraints(constraints)
                        .build();

        WorkManager.getInstance(this).enqueue(rateUpdateWork);
    }
}