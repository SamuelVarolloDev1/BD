namespace Banco_de_Dados
{
    partial class Form1
    {
        /// <summary>
        ///  Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        ///  Clean up any resources being used.
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
        ///  Required method for Designer support - do not modify
        ///  the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            Categoria = new Button();
            SuspendLayout();
            // 
            // Categoria
            // 
            Categoria.Location = new Point(12, 12);
            Categoria.Name = "Categoria";
            Categoria.Size = new Size(192, 23);
            Categoria.TabIndex = 0;
            Categoria.Text = "Cadastro de Categorias";
            Categoria.UseVisualStyleBackColor = true;
            Categoria.Click += Categoria_Click;
            // 
            // Form1
            // 
            AutoScaleDimensions = new SizeF(7F, 15F);
            AutoScaleMode = AutoScaleMode.Font;
            ClientSize = new Size(216, 107);
            Controls.Add(Categoria);
            Name = "Form1";
            Text = "Form1";
            Load += Form1_Load;
            ResumeLayout(false);
        }

        #endregion

        private Button Categoria;
    }
}