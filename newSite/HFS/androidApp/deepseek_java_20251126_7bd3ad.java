package com.mortgageratehub.app.ui.home;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.navigation.Navigation;
import com.mortgageratehub.app.R;

public class HomeFragment extends Fragment {

    private Spinner loanTypeSpinner;
    private EditText creditScoreInput, loanAmountInput;
    private Button checkRatesButton;

    public View onCreateView(@NonNull LayoutInflater inflater,
                             ViewGroup container, Bundle savedInstanceState) {
        View root = inflater.inflate(R.layout.fragment_home, container, false);

        initializeViews(root);
        setupSpinner();
        setupClickListeners();

        return root;
    }

    private void initializeViews(View root) {
        loanTypeSpinner = root.findViewById(R.id.loanTypeSpinner);
        creditScoreInput = root.findViewById(R.id.creditScoreInput);
        loanAmountInput = root.findViewById(R.id.loanAmountInput);
        checkRatesButton = root.findViewById(R.id.checkRatesButton);
    }

    private void setupSpinner() {
        String[] loanTypes = {"30-Year Fixed", "15-Year Fixed", "5/1 ARM", "7/1 ARM", "10/1 ARM"};
        ArrayAdapter<String> adapter = new ArrayAdapter<>(requireContext(), 
            android.R.layout.simple_spinner_item, loanTypes);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        loanTypeSpinner.setAdapter(adapter);
    }

    private void setupClickListeners() {
        checkRatesButton.setOnClickListener(v -> {
            Bundle bundle = new Bundle();
            bundle.putString("loanType", loanTypeSpinner.getSelectedItem().toString());
            bundle.putString("creditScore", creditScoreInput.getText().toString());
            bundle.putString("loanAmount", loanAmountInput.getText().toString());
            
            Navigation.findNavController(v).navigate(R.id.navigation_rates, bundle);
        });
    }
}