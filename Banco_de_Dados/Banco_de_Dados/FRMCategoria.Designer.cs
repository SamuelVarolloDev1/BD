﻿namespace Banco_de_Dados
{
    partial class FRMCategoria
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            txtNome = new TextBox();
            label1 = new Label();
            cmdGravar = new Button();
            grdCateg = new DataGridView();
            cmdExcluir = new Button();
            ((System.ComponentModel.ISupportInitialize)grdCateg).BeginInit();
            SuspendLayout();
            // 
            // txtNome
            // 
            txtNome.Location = new Point(12, 36);
            txtNome.Name = "txtNome";
            txtNome.Size = new Size(377, 23);
            txtNome.TabIndex = 0;
            // 
            // label1
            // 
            label1.AutoSize = true;
            label1.Location = new Point(12, 9);
            label1.Name = "label1";
            label1.Size = new Size(110, 15);
            label1.TabIndex = 1;
            label1.Text = "Nome da Categoria";
            // 
            // cmdGravar
            // 
            cmdGravar.Location = new Point(314, 65);
            cmdGravar.Name = "cmdGravar";
            cmdGravar.Size = new Size(75, 23);
            cmdGravar.TabIndex = 2;
            cmdGravar.Text = "Gravar";
            cmdGravar.UseVisualStyleBackColor = true;
            cmdGravar.Click += cmdGravar_Click;
            // 
            // grdCateg
            // 
            grdCateg.AllowUserToAddRows = false;
            grdCateg.AllowUserToDeleteRows = false;
            grdCateg.AutoSizeColumnsMode = DataGridViewAutoSizeColumnsMode.Fill;
            grdCateg.ColumnHeadersHeightSizeMode = DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            grdCateg.Location = new Point(12, 94);
            grdCateg.Name = "grdCateg";
            grdCateg.ReadOnly = true;
            grdCateg.RowTemplate.Height = 25;
            grdCateg.SelectionMode = DataGridViewSelectionMode.FullRowSelect;
            grdCateg.Size = new Size(377, 274);
            grdCateg.TabIndex = 3;
            // 
            // cmdExcluir
            // 
            cmdExcluir.Location = new Point(314, 374);
            cmdExcluir.Name = "cmdExcluir";
            cmdExcluir.Size = new Size(75, 23);
            cmdExcluir.TabIndex = 4;
            cmdExcluir.Text = "Excluir";
            cmdExcluir.UseVisualStyleBackColor = true;
            cmdExcluir.Click += cmdExcluir_Click;
            // 
            // FRMCategoria
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(401, 409);
            Controls.Add(cmdExcluir);
            Controls.Add(grdCateg);
            Controls.Add(cmdGravar);
            Controls.Add(label1);
            Controls.Add(txtNome);
            Name = "FRMCategoria";
            Text = "FRMCategoria";
            Load += FRMCategoria_Load;
            ((System.ComponentModel.ISupportInitialize)grdCateg).EndInit();
            ResumeLayout(false);
            PerformLayout();
        }

        #endregion

        private TextBox txtNome;
        private Label label1;
        private Button cmdGravar;
        private DataGridView grdCateg;
        private Button cmdExcluir;
    }
}