using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;

namespace Banco_de_Dados
{
    public partial class FRMCategoria : Form
    {
        public FRMCategoria()
        {
            InitializeComponent();
        }

        private void fnListar()
        {
            MySqlDataAdapter oPesquisa = new MySqlDataAdapter("SELECT CTGCODIGO, CTGNOME FROM CATEGORIAS ORDER BY CTGCODIGO DESC", Form1.oConexao);
            DataTable oDados = new DataTable();

            oPesquisa.Fill(oDados);
            grdCateg.DataSource = oDados;
        }

        private void cmdGravar_Click(object sender, EventArgs e)
        {
            MySqlCommand oCmd = new MySqlCommand();

            oCmd.Connection = Form1.oConexao;
            oCmd.CommandText = "INSERT INTO CATEGORIAS (CTGNOME) VALUES (@cNome)";
            oCmd.Parameters.AddWithValue("@cNome", txtNome.Text);

            oCmd.ExecuteNonQuery();
            fnListar();
        }

        private void FRMCategoria_Load(object sender, EventArgs e)
        {
            fnListar();
        }

        private void cmdExcluir_Click(object sender, EventArgs e)
        {
            MySqlCommand oCmd = new MySqlCommand();

            oCmd.Connection = Form1.oConexao;
            oCmd.CommandText = "DELETE FROM CATEGORIAS WHERE CTGCODIGO = @cCod";

            if (grdCateg.SelectedRows.Count > 0)
            {
                oCmd.Parameters.AddWithValue("@cCod", grdCateg.SelectedRows[0].Cells[0].Value);

                oCmd.ExecuteNonQuery();
                fnListar();
            }
        }
    }
}
